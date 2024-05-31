@extends('layouts.auth_app')
@section('title')
    Admin Login
@endsection
@section('content')
<style>
    body {
        background-image: url('https://www.grupoorve.com/media/mageplaza/blog/post/c/u/cuanto_mide_departamento_ideal.jpg');
        /* Ajusta las propiedades de la imagen de fondo según tus necesidades */
        background-size: cover;
        background-position: center;
    }
</style>
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-center align-items-center" style="font-family: 'Averta'; color: black;"><h2>Inicio de sesión</h2></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger p-0">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter Email" tabindex="1" value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña</label>
                                <input id="password" type="password" value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}" placeholder="Enter Password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                                <a href="{{ route('password.request') }}" class="text-small">
                                    Olvidé mi contraseña
                                </a>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Recordar</label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg d-inline-block" tabindex="4">
                                    Iniciar sesión
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            
@endsection
