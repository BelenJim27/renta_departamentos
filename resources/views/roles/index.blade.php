@extends('layouts.app')

@section('content')
@can('ver-rol')
<body style="background-color: #FEFAF6;">
    <section class="section">
        <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px; display: flex; justify-content: center; align-items: center; color: black; font-family: 'Trebuchet MS';">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body" style="justify-content: center; align-items: center; color: black; font-family: 'Trebuchet MS';">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="background-color: #FEFAF6;">
                            @can('crear-rol')    
                            <a class="btn btn-outline-dark" href="{{ route('roles.create') }}" 
                            style="background-color: #EADBC8; border-color: #EADBC8; color: black; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);" 
                            title="Crear nuevo rol">Nuevo rol</a>
                            <div>
                                <br>
                            </div>
                            @endcan

                            <table class="table table-striped mt-2 table_id" id="miTabla2" style="background-color: #fcf3f7; border-color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">
                                <thead style="background-color:#DAC0A3 ">
                                    <tr style="background-color: #DAC0A3; border-color: #605c8c; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#000000; font-family: 'Century Gothic'; width:10%">Rol</th>
                                        <th style="color:#000000; font-family: 'Century Gothic';; width:15%">Nombre</th>
                                        <th style="color:#000000; font-family: 'Century Gothic'; width:40%">Permisos</th>
                                        <th style="color:#000000; font-family: 'Century Gothic'; width:20%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador=0;?>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td style="display: none;">{{ $role->id }}</td>
                                        <td><?php echo $contador=$contador+1;?></td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                        @foreach($role->permissions as $permission)
            {{ $permission->name }}
            @if(!$loop->last)
                ,
            @endif
        @endforeach
                                        </td>
                                        <td>
                                            @if (Gate::check('editar-rol', $role))
                                            <a href="{{ route('roles.edit', $role->id) }}" title="Editar roles">
                                                <i class="fas fa-edit" style="color: #605c8c; font-size: 1.5em; cursor: pointer;"></i>
                                            </a>
                                            @endif

                                            @if (Gate::check('borrar-rol', $role))
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'class'=>'formulario-eliminar','style' => 'display:inline']) !!}
                                            <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none; background: none;" title="Borrar Rol">
                                                <i class="fas fa-trash-alt" style="color: red; font-size: 1.5em; cursor: pointer;"></i>
                                            </button>
                                            {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <tr>
                                <td colspan="8" style="background-color: #fffcf4;" class="text-center">{{ $roles->links() }}</td>
                            </tr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#miTabla2', {
            lengthMenu: [
                [2, 5, 10],
                [2, 5, 10]
            ],

            columns: [
                { Id: 'Id' },
                { Rol: 'Rol' },
                { Name: 'Name' },
                { Permisos: 'Permisos' },
                // { Guard_name: 'Guard_name'},
                { Acciones: 'Acciones' }
            ],

            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    </script>

@if(session('eliminar')=='ok')
    <script>
        Swal.fire({
            title: "¡Éxito!",
            text: "Rol eliminado",
            icon: "success"
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            Swal.fire({
                title: "¿Está seguro de eliminar el Rol?",
                text: "¡No se podrán revertir los cambios!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, enviar el formulario
                    $(this).unbind('submit').submit();
                }
            });
        });
    });
</script>
</body>
@endcan
@endsection