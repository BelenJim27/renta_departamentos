<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Departamento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $cant_usuarios = User::count();
    $cant_roles = Role::count();
    $cant_departamentos = Departamento::count();

    return view('home', compact('cant_usuarios', 'cant_roles', 'cant_departamentos'));
}
}
