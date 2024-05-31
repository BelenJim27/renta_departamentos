@extends('layouts.app')
@can('ver-usuario')
@section('content')


<body style="background-color: #FEFAF6;">

<style>
    .btn.btn-dark:hover {
        background-color: black;
        color: white;
        border-color: black;
    }
</style>
<section class="section">
    <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px;display: flex; justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
        <h3 class="page__heading">Usuarios</h3>
    </div>
    <div class="section-body" style="color: black;font-family: 'Trebuchet MS';">
        <div class="row" style="background-color: #FEFAF6;">
            <div class="col-lg-12" style="background-color: #FEFAF6;">
                <div class="card" style="background-color: #FEFAF6;">
                    <div class="card-body" style="background-color: #FEFAF6;">

                        @can('crear-usuario')  
                        <a class="btn btn-outline-dark" style="background-color: #EADBC8; color: black; border-color: #EADBC8;box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);font-family: 'Century Gothic';" href="{{ route('usuarios.create') }}">
                            
                            <span class="button-text">Crear Usuario</span>
                        </a>
                        @endcan

                        <div>
                            <br>
                        </div>

                        <table class="table table-striped mt-2 table_id" id="miTabla1" style="background-color: #fcf3f7;border-color: white;box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">
                            <thead style="background-color:#DAC0A3">
                                <th style="color:#000000;font-family: 'Century Gothic'">Nombre</th>
                                <th style="color:#000000;font-family: 'Century Gothic'">Apellidos</th>
                                <th style="color:#000000;font-family: 'Century Gothic'">Teléfono</th>
                                <th style="color:#000000;font-family: 'Century Gothic'">Correo electrónico</th>
                                <th style="color:#000000;font-family: 'Century Gothic'">Rol</th>
                                <th style="color:#000000;font-family: 'Century Gothic'">Acciones</th>
                            </thead>
                            <tbody>
                                
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    
                                    <td style="width: 10%;">{{ $usuario->name }}</td>
                                    <td style="width: 15%;">{{ $usuario->apellido_p }} {{ $usuario->apellido_m }}</td>
                                    <td style="width: 10%;">{{ $usuario->phone_number }}</td>
                                    <td style="width: 15%;">{{ $usuario->email }}</td>
                                    <td style="width: 10%;">{{ $usuario->roles()->pluck('name')->implode(', ') }}</td>
                                    <td style="width: 10%;">
                                        @if (Gate::check('editar-usuario', $usuario))
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar usuarios">
                                            <i class="fas fa-edit" style="color: #2C43C8; font-size: 1.5em; cursor: pointer;"></i>
                                        </a>
                                        @endif

                                        @if (Gate::check('borrar-usuario', $usuario))
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['usuarios.destroy', $usuario->id],'class'=>'formulario-eliminar', 'style' => 'display:inline']) !!}
                                        <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none; background: none;" title="Borrar usuario">
                                            <i class="fas fa-trash-alt" style="color: #DB7373; font-size: 1.5em; cursor: pointer;"></i>
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
                            <td colspan="8" style="background-color: #fffcf4;" class="text-center">{{ $usuarios->links() }}</td>
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
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#miTabla1', {
            lengthMenu: [
                [2, 5, 10],
                [2, 5, 10]
            ],
            
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
            }
        });

</script>
<!-- Agregar SweetAlert2 script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar')=='ok')
    <script>
        Swal.fire({
            title: "¡Éxito!",
            text: "Usuario eliminado",
            icon: "success"
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            Swal.fire({
                title: "¿Está seguro de eliminar al usuario?",
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
@endsection

@endcan