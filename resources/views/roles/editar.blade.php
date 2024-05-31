@extends('layouts.app')

@section('content')
@can('ver-rol')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-body" style="background-color: #fffcf4;">
                        <div class="card-body">
                        <label class="text-danger">Los campos con * son obligatorios</label>
                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del Rol:</label> <span class="required text-danger">*</span>
                                {!! Form::select('name', ['Administrador' => 'Administrador','Cliente' => 'Cliente', 'Arendador' => 'Arendador'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un rol']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Permisos para este Rol:</label><span class="required text-danger">*</span>
                                <br/>
                                <div class="row">
                                    @foreach($permission as $value)
                                        <div class="col-xs-3 col-sm-3">
                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="margin-right: 5px; background-color: #ff7464; border-color: #ff7464; color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Guardar</button>
                        <a href="/roles" class="btn btn-warning" style="background-color: #605c8c; border-color: #605c8c; color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Cancelar</a>
                        {!! Form::close() !!}

                    </div>
                    {!! Form::close() !!}

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
            $(document).ready(function() {
                $('#formulario-editar').submit(function(e) {
                    e.preventDefault(); // Evitar el envío del formulario

                    Swal.fire({
                        title: "¿Está seguro de generar los cambios?",
                        text: "¡No se podrán revertir los cambios!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Guardar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si se confirma, enviar el formulario
                            $(this).unbind('submit').submit();
                        }
                    });
                });
            });
        </script>
        @endcan
@endsection