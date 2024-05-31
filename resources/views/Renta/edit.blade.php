@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header" style="justify-content: center; align-items: center; font-family: 'Trebuchet MS';">
        <h3 class="page__heading">Actualización de departamentos</h3>
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

                        <form id="formulario-editar" action="{{ route('departamentos.update', $departamento->id) }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="imagen">Imagen<span class="required text-danger">*</span></label>
                                        <input type="file" name="imagen" id="imagen" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                            <label for="disponibilidad">Disponibilidad</label><span class="required text-danger">*</span>
                                            <select class="form-control" name="disponibilidad" id="disponibilidad">
                                                <option value="disponible">Disponible</option>
                                                <option value="no_disponible">No Disponible</option>
                                            </select>
                                        </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio_renta">Precio Renta</label><span class="required text-danger">*</span>
                                        {!! Form::number('precio_renta', $departamento->precio_renta, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label><span class="required text-danger">*</span>
                                            {!! Form::textarea('descripcion', $departamento->descripcion, array('class' => 'form-control textarea-large')) !!}
                                        </div>
                                    </div>
                                    </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="colonia">Colonia</label><span class="required text-danger">*</span>
                                        {!! Form::text('colonia', $departamento->Domicilio->colonia, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="calle">Calle</label><span class="required text-danger">*</span>
                                        {!! Form::text('calle', $departamento->Domicilio->calle, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numero">Número</label><span class="required text-danger">*</span>
                                        {!! Form::text('numero', $departamento->Domicilio->numero, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-dark" style="background-color: #ff7464;border-color: #ff7464;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Actualizar</button>
                                    <a href="{{ route('departamentos.index') }}" class="btn btn-outline-dark" style="background-color: #605c8c;border-color: #605c8c;color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JQUERY -->

</section>
@yield('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        $("#formulario-editar").submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: "¿Deseas guardar los cambios?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Guardar",
                denyButtonText: `No guardar`
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                } else if (result.isDenied) {
                    Swal.fire("Los cambios no se guardaron", "", "info");
                }
            });
        });
    });
</script>
@endsection
