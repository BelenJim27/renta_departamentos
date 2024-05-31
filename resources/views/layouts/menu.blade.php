
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
<div class="dropdown-title" style="display: flex; justify-content: center; align-items: center; color: black; font-family: 'Trebuchet MS';">
                     {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
    
    <a class="nav-link" href="/home" style="color:black;background-color: #DDE2FF;margin-top: 15px;border-radius: 13px;width: 90%; 
  left: 5%;">
        <i class=" fas fa-building"></i><span>Inicio</span>
    </a>
  
    @can('ver-usuario')
    <a class="nav-link" href="/usuarios" style="color:black;background-color: #DDE2FF;margin-top: 15px;border-radius: 13px;width: 90%; 
  left: 5%;">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    @endcan
    @can('ver-rol')
    <a class="nav-link" href="/roles" style="color:black;background-color: #DDE2FF;margin-top: 15px;border-radius: 13px;width: 90%; 
  left: 5%;">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    @endcan
    @can('ver-departamento')
    <a class="nav-link" href="/departamentos" style="color:black;background-color: #DDE2FF;margin-top: 15px;border-radius: 13px;width: 90%; 
  left: 5%;">
        <i class=" fas fa-city"></i><span>Departamentos</span>
    </a>
    @endcan
    @can('ver-renta')
    <a class="nav-link" href="/rentas" style="color:black;background-color: #DDE2FF;margin-top: 15px;border-radius: 13px;width: 90%; 
  left: 5%;">
        <i class=" fas fa-users"></i><span>Rentas</span>
    </a>
    @endcan
    
</li>
