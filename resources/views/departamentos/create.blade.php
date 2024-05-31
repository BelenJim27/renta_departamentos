@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="justify-content: center; align-items: center; font-family: 'Trebuchet MS';">
            <h3 class="page__heading">Alta de Departamento</h3>
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

                            {!! Form::open(['route' => 'departamentos.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                @csrf
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="imagen">Imagen</label><span class="required text-danger">*</span>
                                            <br>
                                            {!! Form::file('imagen', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="disponibilidad">Disponibilidad</label><span class="required text-danger">*</span>
                                            <select class="form-control" name="disponibilidad" id="disponibilidad">
                                                <option value="disponible">Disponible</option>
                                                <option value="no_disponible">No Disponible</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="precio_renta">Precio renta</label><span class="required text-danger">*</span>
                                            {!! Form::number('precio_renta', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label><span class="required text-danger">*</span>
                                            {!! Form::textarea('descripcion', null, array('class' => 'form-control textarea-large')) !!}
                                        </div>
                                    </div>
                                </div>
                                
                            <div class='row'>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="colonia">Colonia</label><span class="required text-danger">*</span>
                                            {!! Form::text('colonia', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="calle">Calle</label><span class="required text-danger">*</span>
                                            {!! Form::text('calle', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="numero">Número</label><span class="required text-danger">*</span>
                                            {!! Form::number('numero', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-outline-dark" style="background-color: #ff7464; border-color: #ff7464; color: white; box-shadow: 3px 3px 6px rgba(0.5, 0.5, 0.5, 0.5);">Guardar</button>
                                        <a href="/departamentos" class="btn btn-outline-dark" style="background-color: #605c8c; border-color: #605c8c; color: white; box-shadow: 3px 3px 6px rgba(0.5, 0.5, 0.5, 0.5);">Cancelar</a>
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
