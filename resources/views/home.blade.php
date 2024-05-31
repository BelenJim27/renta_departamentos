@extends('layouts.app')

@section('content')
<body style="background-color: #FEFAF6;">
    <section class="section" style="background-color: #FEFAF6;">
        <div class="section-header" style="background-color: #FEFAF6;">
            <h3 class="page__heading">Control</h3>
        </div>
        <div class="section-body" style="background-color: #FEFAF6;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body"style="background-color: #FEFAF6;">                          
                                <div class="row">
                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                @can('ver-usuario')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-blue order-card">
                                            <div class="card-block">
                                            <h5>Usuarios</h5>                                               
                                                
                                                
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                    @endcan
                                    @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp
                                    @can('ver-rol')
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card" style="background-color: #FC7DAC;color: #FFFFFF;">
                                            <div class="card-block">
                                            <h5>Roles</h5> 
                                                                                          
                                                
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                     <div class="col-md-4 col-xl-4">
                                    <div class="card" style="background-color: #FEE869;color: #FFFFFF;">
                                            <div class="card-block">
                                            <h5>Departamentos</h5>                                               
                                                @php
                                                 use App\Models\Departamento;
                                                $cant_departamentos = Departamento::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-building f-left"></i><span>{{$cant_departamentos}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/departamentos" class="text-white">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                                                                                    
                                   
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection

