<?php

namespace App\Http\Controllers;
use App\Models\Departamento;
use App\Models\Renta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComprobanteMail;
use PDF;
use Carbon\Carbon;
class RentaController extends Controller
{
    public function index()
     {      
         // Obtener todos los registros de Carrito con los productos asociados mediante un inner join
         $rentas = Renta::join('departamentos', 'rentas.departamento_id', '=', 'departamentos.id')
    ->join('domicilios', 'departamentos.domicilio_id', '=', 'domicilios.id')
    ->get(['rentas.id as renta_id', 'rentas.*', 'departamentos.*', 'domicilios.*']);

        //$departamentos=Departamento::find()->all();
        //  foreach ($rentas as $renta) {
        //     $departamento = Departamento::find($renta->departamento_id);
        //     if ($departamento && $renta->fecha_fin < now()) {
        //         $departamento->disponibilid = 'disponible';
        //         $departamento->save();
        //     }
        // }
         // Pasar los datos de carritos a la vista
         
         return view('rentas.index', compact('rentas'));
     }
     public function pdf($id)
    {
        $renta = Renta::with('departamento.domicilio', 'user')->findOrFail($id);

        // Obtener los datos del departamento y domicilio asociados a la renta
        $departamento = $renta->departamento;
        $domicilio = $departamento->domicilio;
        $user = $renta->user; // Usuario asociado a la renta

        $pdf = PDF::loadView('rentas.comprobante', compact('renta', 'departamento', 'domicilio','user'));
        $pdfPath = public_path('pdfs/comprobante.pdf');
        $pdf->save($pdfPath);
        Mail::to($user->email)->send(new ComprobanteMail($pdfPath, $renta, $departamento, $domicilio, $user));
        return $pdf->stream(); //aquí está el error de la ruta
    }
    //
    public function store(Request $request)
{
    $data = request()->validate([
       
        'periodo' => 'required',
        'fecha_ini' => 'required',
        'fecha_fin' => 'required',
        'user_id' => 'required',
        'departamento_id' => 'required',

    ]);
    $fechaActual = Carbon::now();

// Obtener el periodo seleccionado del formulario
$periodoSeleccionado = $request->input('periodo');

// Establecer la fecha de inicio como la fecha actual
$fechaInicio = $fechaActual;

// Establecer la fecha de finalización basada en el periodo seleccionado
if ($periodoSeleccionado == '1 Mes') {
    $fechaFin = $fechaInicio->copy()->addMonth();
} elseif ($periodoSeleccionado == '3 Meses') {
    $fechaFin = $fechaInicio->copy()->addMonths(3);
} elseif ($periodoSeleccionado == '6 Meses') {
    $fechaFin = $fechaInicio->copy()->addMonths(6);
} else {
    // En caso de que no se seleccione ningún periodo
    $fechaFin = null;
}
     $data['fecha_fin']=$fechaFin->format('Y-m-d');
    $renta = Renta::create([
        'periodo' => $data['periodo'],
        'fecha_ini' => $data['fecha_ini'],
        'fecha_fin' => $data['fecha_fin'],
        'user_id' => $data['user_id'],
        'departamento_id' => $data['departamento_id'],
        
        //'roles_id' => $roles_id->id,
    ]);
    
    $dep = new DepartamentoController();
        
        // Llama al método del otro controlador
        $dep->actualizarD($data['departamento_id']);
        
    return redirect()->route('rentas.comprobante', ['id' => $renta->id]);

}
    public function show($id){

    }
    public function edit($id){

    }
    public function update(Request $request, $id){

    }
    public function destroy(Renta $renta)
{
    $departamento = Departamento::find($renta->departamento_id);
        $departamento->disponibilidad = 'disponible';
        $departamento->save();

        $renta->delete();

        return redirect()->route('rentas.index')->with('eliminar', 'ok');
}



}
