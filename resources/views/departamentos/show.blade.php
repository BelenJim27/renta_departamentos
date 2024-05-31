@extends('layouts.app')
@php
    use Carbon\Carbon;
    $fechaActual = Carbon::now()->format('Y-m-d'); // Formato de fecha (año-mes-día)
@endphp
@section('content')
<body style="background-color: #FEFAF6;">
    <section class="section">
        <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px; display: flex; justify-content: center; align-items: center; color: #333; font-family: 'Arial', sans-serif;">
            <h3 class="page__heading">Departamento</h3>
        </div>
        
        <div><br></div>        
        <div class="table-responsive">
            <div class="card mb-4" style="background-color: #fcf3f7; border-color: white; box-shadow: 3px 3px 6px rgba(0.5, 0.5, 0.5, 0.5); padding: 20px; font-family: 'Trebuchet MS'; color: #333;">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ Storage::url($departamento->imagen) }}" class="departamento-card img" alt="Imagen del departamento" width="250" height="250">
                    </div>
                    <div class="col-md-8">
                        <h5>Disponibilidad: {{ $departamento->disponibilidad }}</h5>
                        <h5>Precio de renta: ${{ number_format($departamento->precio_renta, 2, '.', ',') }}</h5>
                        <h5>Dirección: Calle {{ $departamento->Domicilio->calle }} #{{ $departamento->Domicilio->numero }}, Colonia {{ $departamento->Domicilio->colonia }}</h5>
                        <h5>Descripción: </h5>
                        <p>{{ $departamento->descripcion }}</p>

                        @if($departamento->disponibilidad == 'disponible')
                            <div class="container">
                                {!! Form::open(['route' => 'rentas.store', 'method' => 'POST', 'id' => 'rentaForm']) !!}
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="periodo">Periodo:</label><span class="text-danger">*</span>
                                            <select id="periodo" name="periodo" class="form-control{{ $errors->has('periodo') ? ' is-invalid' : '' }}" tabindex="9" required>
                                                <option value="" disabled selected>Selecciona el periodo</option>
                                                <option value="1 Mes" {{ old('periodo') == '1-mes' ? 'selected' : '' }}>1 Mes</option>
                                                <option value="3 Meses" {{ old('periodo') == '3-mes' ? 'selected' : '' }}>3 Meses</option>
                                                <option value="6 Meses" {{ old('periodo') == '6-mes' ? 'selected' : '' }}>6 Meses</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('periodo') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center justify-content-start">
                                        {!! Form::hidden('periodo', '', ['id' => 'hiddenPeriodo']) !!}
                                        {!! Form::hidden('fecha_ini', $fechaActual) !!}
                                        {!! Form::hidden('fecha_fin', '1') !!}
                                        {!! Form::hidden('user_id', Auth::id()) !!}
                                        {!! Form::hidden('departamento_id', $departamento->id) !!}
                                        {!! Form::button('<i class="fas fa-handshake" style="color: black;"></i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submitButton']) !!}

                                    </div>
                                </div>
                                {!! Form::close() !!}
                                   
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const periodoSelect = document.getElementById('periodo');
            const hiddenPeriodo = document.getElementById('hiddenPeriodo');

            // Actualiza el valor del campo oculto cuando cambia el valor del select
            periodoSelect.addEventListener('change', function () {
                hiddenPeriodo.value = periodoSelect.value;
            });

            // Asegúrate de que el valor oculto esté actualizado cuando se cargue la página
            hiddenPeriodo.value = periodoSelect.value;
        });
    </script>

    <script>
        document.getElementById('submitButton').addEventListener('click', function(event) {
            event.preventDefault(); // Previene el envío inmediato del formulario
            var confirmation = confirm('¿Estás seguro de que quieres rentar?');
            if (confirmation) {
                document.getElementById('rentaForm').submit();
            }
            
        });
    </script>
</body>
@endsection
