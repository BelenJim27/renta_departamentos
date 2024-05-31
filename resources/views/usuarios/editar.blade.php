@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
        <h3 class="page__heading" style="text-align: center;">Editar Usuario</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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

                            {!! Form::model($user, ['method' => 'PATCH','route' => ['usuarios.update', $user->id],'id'=>'formulario-editar']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label><span class="required text-danger">*</span>
                                        {!! Form::text('name', $user->name, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido Paterno</label><span class="required text-danger">*</span>
                                        {!! Form::text('apellido_p', $user->apellido_p, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido Materno</label><span class="required text-danger">*</span>
                                        {!! Form::text('apellido_m',  $user->apellido_m, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Teléfono</label><span class="required text-danger">*</span>
                                        {!! Form::text('phone_number', $user->phone_number, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Rol</label><span class="required text-danger">*</span>
                                        {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-mail</label><span class="required text-danger">*</span>
                                        {!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Contraseña</label><span class="required text-danger">*</span>
                                        {!! Form::password('password', array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm-password">Confirmar contraseña</label><span class="required text-danger">*</span>
                                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                               
                                <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-dark" style="background-color: #ff7464;border-color: #ff7464;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Actualizar</button>
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-dark" style="background-color: #605c8c;border-color: #605c8c;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Cancelar</a>
                                </div>
                            </div>
                        </form>
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
@endsection
