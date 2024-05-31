<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domicilio;


//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        //Sin paginación
        $usuarios = User::paginate(5);
        //$usuarios = User::all();
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */

        //Con paginación
        // $usuarios = User::paginate(2);
        return view('usuarios.index',compact('usuarios'));

        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = request()->validate([
        'name' => 'required',
        'apellido_p' => 'required',
        'apellido_m' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
        'roles' => 'required',
        
    ]);

    $input = $request->all();
    $input['password'] = Hash::make($input['password']);

    

    $usuario = User::create([
        'name' => $data['name'],
        'apellido_p' => $data['apellido_p'],
        'apellido_m' => $data['apellido_m'],
        'phone_number' => $data['phone_number'],
        'email' => $data['email'],
        'password' => $input['password'],
        //'roles_id' => $roles_id->id,
    ]);

    $usuario->assignRole($request->input('roles'));

    return redirect()->route('usuarios.index');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('usuarios.editar',compact('user','roles','userRole'));
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
        $data = request()->validate([
            'name' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes|required|same:confirm-password',
            'roles' => 'required',
        ]);
    
        $usuario = User::findOrFail($id);
    
        $usuario->name = $data['name'];
        $usuario->apellido_p = $data['apellido_p'];
        $usuario->apellido_m = $data['apellido_m'];
        $usuario->phone_number = $data['phone_number'];
        $usuario->email = $data['email'];
    
        if (!empty($data['password'])) {
            $usuario->password = Hash::make($data['password']);
        }
        $usuario->save();

        // Asignar roles
        $usuario->syncRoles($request->input('roles'));
    
        return redirect()->route('usuarios.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('eliminar','ok');
    }

}
