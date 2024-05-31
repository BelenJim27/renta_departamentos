@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="
  justify-content: center; align-items: center;font-family: 'Trebuchet MS';">
            <h3 class="page__heading" style="text-align: center;">Alta de Usuario</h3>
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

                            {!! Form::open(array('route' => 'usuarios.store','method'=>'POST','enctype'=>"multipart/form-data")) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label><span class="required text-danger">*</span>
                                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido_p">Apellido Paterno</label><span class="required text-danger">*</span>
                                        {!! Form::text('apellido_p', null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido_m">Apellido Materno</label><span class="required text-danger">*</span>
                                        {!! Form::text('apellido_m', null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Teléfono</label><span class="required text-danger">*</span>
                                        <div class="input-group">
                                        {!! Form::select('area_code', [
                                            '52' => 'México (+52)',
                                            '502' => 'Guatemala (+502)',
                                            '1' => 'Estados Unidos/Canadá (+1)',]) !!}

                                        {!! Form::text('phone_number', null, array('class' => 'form-control')) !!}
                                    </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label><span class="required text-danger">*</span>
                                        {!! Form::text('email', null, array('class' => 'form-control')) !!}
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
                                        <label for="password_confirmation">Confirmar Contraseña</label><span class="required text-danger">*</span>
                                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Rol</label><span class="required text-danger">*</span>
                                        {!! Form::select('roles[]',$roles,[],array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-dark" style="background-color: #ff7464;border-color: #ff7464;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Guardar</button>
                        <a href="/roles" class="btn btn-outline-dark" style="background-color: #605c8c;border-color: #605c8c;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Cancelar</a>
                               

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection