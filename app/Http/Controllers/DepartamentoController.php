<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\User;
use App\Models\Domicilio;
use Illuminate\Support\Facades\Storage;
use PDF;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //      $this->middleware('permission:ver-terreno|crear-terreno|editar-terreno|borrar-terreno', ['only' => ['index']]);
    //      $this->middleware('permission:crear-terreno', ['only' => ['create','store']]);
    //      $this->middleware('permission:editar-terreno', ['only' => ['edit','update']]);
    //      $this->middleware('permission:borrar-terreno', ['only' => ['destroy']]);
    // }
    public function index(Request $request)
{
    $query = Departamento::query();

    // Filtrar por disponibilidad
    $query->where('disponibilidad', 'Disponible');

    // Filtrar por precio
    if ($request->filled('min_price')) {
        $query->where('precio_renta', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('precio_renta', '<=', $request->max_price);
    }

    $departamentos = $query->paginate(15); // Ajusta la paginación según tu necesidad

    return view('departamentos.index', compact('departamentos'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validar la solicitud
    $data = $request->validate([
        'disponibilidad' => 'required',
        'precio_renta' => 'required',
        'descripcion' => 'required',
        'calle' => 'required',
        'numero' => 'required',
        'colonia' => 'required',
        'imagen' => 'required|image', // Regla de validación para la imagen
    ]);

    // Subir la imagen al sistema de archivos y obtener la ruta
    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('public/fotos');
    } else {
        // Si no se proporciona una imagen, puedes asignar un valor predeterminado o lanzar una excepción
        // Por ejemplo, puedes asignar una imagen por defecto
        $path = 'public/fotos/departamento.png'; // Cambia esto a la ruta de tu imagen predeterminada
    }

    // Crear el domicilio
    $domicilio = Domicilio::create([
        'calle' => $data['calle'],
        'numero' => $data['numero'],
        'colonia' => $data['colonia'],
    ]);

    // Crear el departamento y asignar el ID del domicilio creado
    $departamento = Departamento::create([
        'disponibilidad' => $data['disponibilidad'],
        'precio_renta' => $data['precio_renta'],
        'descripcion' => $data['descripcion'],
        'imagen' => $path, // Ruta de la imagen
        'domicilio_id' => $domicilio->id,
    ]);

    return redirect()->route('departamentos.index');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento=Departamento::find($id);
        return view('departamentos.show',['departamento'=>$departamento]);
        // $departamento = Departamento::find($id);
        // if (!$departamento) {
        //     return redirect()->route('departamentos.index')->with('error', 'Department not found.');
        // }
         //return view('departamentos.show', compact('departamento'));

    
    }
 
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarD($id){
        $departamento = Departamento::find($id);
        $departamento->disponibilidad = 'No disponible';

        $departamento->save();
    }

    public function actualizarDe($id){
        $departamento = Departamento::find($id);
        $departamento->disponibilidad = 'No disponible';

        $departamento->save();
    }
    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit',compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validate the request
    $data = $request->validate([
        'disponibilidad' => 'required',
        'precio_renta' => 'required',
        'descripcion' => 'required',
        'calle' => 'required',
        'numero' => 'required',
        'colonia' => 'required',
        'imagen' => 'image', // Regla de validación para la imagen
    ]);
    // Recuperar el terreno existente que se va a editar
    $departamento = Departamento::findOrFail($id);
    $domicilio=$departamento->domicilio;
    // Actualizar los datos del domicilio
    $domicilio->update([
        'calle' => $data['calle'],
        'numero' => $data['numero'],
        'colonia' => $data['colonia'],
    ]);
    // Actualizar los datos del cliente
    $departamento->update([
        'disponibilidad' => $data['disponibilidad'],
        'precio_renta' => $data['precio_renta'],
        'descripcion' => $data['descripcion'],
    ]);
    
    

    // Check if a file has been uploaded
    if ($request->hasFile('imagen')) {
        // Eliminar la imagen anterior
        Storage::delete($departamento->imagen);
    
        // Subir la nueva imagen al sistema de archivos y obtener la ruta
        $path = $request->file('imagen')->store('public/fotos');
        $departamento->imagen = $path;
    }
    $departamento->save();

    return redirect()->route('departamentos.index');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('eliminar','ok');
    }
}
