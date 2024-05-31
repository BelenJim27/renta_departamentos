@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@section('content')
@can('ver-renta')
<body style="background-color: #FEFAF6;">
    <section class="section">
        <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px;display: flex; justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
            <h3 class="page__heading">Rentas</h3>
        </div>
        <div class="section-body" style="justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
        
        
                            <div><br></div>        
                            <div class="table-responsive">
                                <table class="table table-striped mt-2" id="miTabla3" style="background-color: #fcf3f7; border-color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5); margin: 20px;">
                                    <thead style="background-color: #DAC0A3;">
                                        <tr style="background-color: #DAC0A3; border-color: #605c8c; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
                                        
                                        <th style="color: #000000; width: 10%;">ID Cliente</th>
                                        
                                        <th style="color: #000000; width: 10%;">Imagen</th>
                                            <th style="color: #000000; width: 5%;">Precio Renta</th>
                                            <th style="color: #000000; width: 5%;">Periodo</th>
                                            <th style="color: #000000; width: 10%;">Fecha inicio</th>
                                            <th style="color: #000000; width: 10%;">Fecha Fin</th>
                                            <th style="color: #000000; width: 10%;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @foreach ($rentas as $renta)
                                        @cannot('editar-renta')
                                        @if($renta->user_id==Auth::user()->id)
                                            <tr>
                                            <td style="width: 5%;">{{ $renta->user_id }}</td>
                                            <td style="width: 10%;">
                                            
                                                <img src="{{ Storage::url($renta->departamento->imagen) }}" alt="Imagen del departamento" width="100" height="100" class="imagen-departamento" data-toggle="modal" data-target="#imagenModal" data-imagen="{{ Storage::url($renta->imagen) }}">
                                                </td>
                                                <td style="width: 5%;">${{ number_format($renta->departamento->precio_renta, 2, '.', ',') }}</td>
                                                <td style="width: 5%;">{{ $renta->periodo }}</td>
                                                <td style="width: 10%;">
    {{ Carbon::parse($renta->fecha_ini)->translatedFormat('j \d\e F \d\e Y') }}
</td>

<td style="width: 10%;">
    {{ Carbon::parse($renta->fecha_fin)->translatedFormat('j \d\e F \d\e Y') }}
</td>

                                                <td style="width: 10%; padding: 10px;"> 
                                                    @if (Gate::check('borrar-renta', $renta))
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['rentas.destroy', $renta->id], 'class'=>'formulario-eliminar','style' => 'display:inline']) !!}
                                                        <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none; background: none;" title="Borrar Departamento">
                                                            <i class="fas fa-trash-alt" style="color: red; font-size: 1.5em; cursor: pointer;"></i>
                                                        </button> 
                                                        {!! Form::close() !!}
                                                    @endif
                                                    <a href="{{ route('departamentos.show', $renta->departamento_id) }}" ><i class="fas fa-eye" title="Ver mas" style="font-size: 1.5em;color:black"></i></a>
                                                    <a href="{{ route('rentas.comprobante', $renta->renta_id) }}" ><i class="fas fa-file-pdf" title="descargar comprobante" style="font-size: 1.5em; color:blue"></i></a>
                                                </td>
                                            </tr>
                                            @endif
                                            @endcannot
                                            @can('editar-renta')
                                            <tr>
                                            <td style="width: 5%;">{{ $renta->user_id }}</td>
                                            <td style="width: 10%;">
                                                <img src="{{ Storage::url($renta->departamento->imagen) }}" alt="Imagen del departamento" width="100" height="100" class="imagen-departamento" data-toggle="modal" data-target="#imagenModal" data-imagen="{{ Storage::url($renta->imagen) }}">
                                                </td>
                                                <td style="width: 5%;">${{ number_format($renta->departamento->precio_renta, 2, '.', ',') }}</td>
                                                <td style="width: 5%;">{{ $renta->periodo }}</td>
                                                <td style="width: 10%;">
                                                    {{ Carbon::parse($renta->fecha_ini)->translatedFormat('j \d\e F \d\e Y') }}
                                                </td>

                                                <td style="width: 10%;">
                                                    {{ Carbon::parse($renta->fecha_fin)->translatedFormat('j \d\e F \d\e Y') }}
                                                </td>
                                                <td style="width: 10%; padding: 10px;"> 
                                                    @if (Gate::check('borrar-renta', $renta))
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['rentas.destroy', $renta->renta_id], 'class'=>'formulario-eliminar','style' => 'display:inline']) !!}
                                                        <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none; background: none;" title="Borrar Departamento">
                                                         <i class="fas fa-trash-alt" style="color: red; font-size: 1.5em; cursor: pointer;"></i>
                                                        </button> 
                                                        {!! Form::close() !!}
                                                    @endif
                                                    <a href="{{ route('departamentos.show', $renta->departamento_id) }}" ><i class="fas fa-eye" title="Ver mas" style="font-size: 1.5em;color:black"></i></a>
                                                    <a href="{{ route('rentas.comprobante', $renta->renta_id) }}" ><i class="fas fa-file-pdf" title="descargar comprobante" style="font-size: 1.5em; color:blue"></i></a>
                                                </td>
                                            </tr>
                                            @endcan
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
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
       new DataTable('#miTabla3', {
                lengthMenu: [
                    [2, 5, 10],
                    [2, 5, 10]
                ],
                columns: [
                    {id:'id_cliente'},
                    {id:'imagen'},
                    {id:'precio_renta'},
                    {id:'periodo'},
                    {id:'fecha_ini'},
                    {id:'fecha_fin'},
                    {id:'acciones'}
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
                text: "rentas eliminado",
                icon: "success"
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.formulario-eliminar').submit(function(e) {
                e.preventDefault(); // Evitar el envío del formulario
                Swal.fire({
                    title: "¿Está seguro de eliminar el rentas?",
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
    @endcan
</body>
@endsection
