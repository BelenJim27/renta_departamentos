@extends('layouts.app')

@section('content')


<body style="background-color: #FEFAF6;">
    
    <section class="section">
        
        <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px;display: flex; justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
            <h3 class="page__heading">Departamentos</h3>
        </div>
<!-- Formulario de búsqueda -->
<div class="row justify-content-center mb-3">
    <div class="col-lg-6">
        <form action="{{ route('departamentos.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="min_price" class="form-control" placeholder="Precio mínimo">
                <input type="text" name="max_price" class="form-control" placeholder="Precio máximo">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('departamentos.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>

                    
        <div class="section-body" style="justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" style="background-color: #FEFAF6;">
                            @can('crear-departamento') 
                                <a class="btn btn-outline-dark" href="{{ route('departamentos.create') }}" 
                                style="background-color: #EADBC8;border-color: #EADBC8;color: black; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);" 
                                title="Nuevo departamento">Nuevo Departamento</a>
                                <div><br></div>
                            @endcan
                            
                            <div><br></div>        
                            <div class="table-responsive">
                                
                            <div class="section-body" style="justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
                            
                    
                            <div class="row justify-content-center">
                        @foreach ($departamentos as $departamento)
                        
                            <div class="col-lg-4 mb-4">
                            <head>
                    <!-- Resto de las etiquetas head -->
                    
                </head>

                <div class="card" style="background-color: #fcf3f7; border-color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">
                    
                <img src="{{ Storage::url($departamento->imagen) }}" class="card-img-top" alt="Imagen del terreno" style="height: 200px; object-fit: cover;" data-toggle="modal" data-target="#imagenModal" >
                    <div class="card-body">
                        <h5 class="card-title">{{ $departamento->nombre }}</h5>
                        <p class="card-text">Precio Renta: ${{ number_format($departamento->precio_renta, 2, '.', ',') }}</p>
                        <p class="card-text">Dirección: Calle {{ $departamento->Domicilio->calle }} #{{ $departamento->Domicilio->numero }}, Colonia {{ $departamento->Domicilio->colonia }}</p>
                        <!--<p class="card-text">Descripción: {{ $departamento->descripcion }}</p>-->
                        
                        <a href="{{ route('departamentos.show', $departamento->id) }}" class="btn btn-primary">Ver más</a>
                        
                        <!-- Botones de acción -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col text-center" style="padding: 10px;">
                                <!-- Botón para editar departamento -->
                                @if (Gate::check('editar-departamento', $departamento))
                                    <a href="{{ route('departamentos.edit', $departamento->id) }}" title="Editar departamento">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </a>
                                @endif
                            </div>

                            <div class="col text-center" style="padding: 10px;">
                                <!-- Botón para borrar departamento -->
                                @if (Gate::check('borrar-departamento', $departamento))
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['departamentos.destroy', $departamento->id], 'class'=>'formulario-eliminar', 'style' => 'display:inline']) !!}
                                    <button type="submit" class="btn btn-link" style="color: inherit; padding: 0; border: none; background: none;" title="Borrar Departamento">
                                        <i class="fas fa-trash-alt" style="color: red; font-size: 1.5em;"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endif
                            </div>

                            
                                <!-- Botón para rentar -->
                                
                                

                            </div>
                        </div>
                    </div>
                </div>
            
        @endforeach
        
            </div>
        </div>
        </div>

</div>
</div>


                                <tr>
                                    <td  colspan="8" style="background-color: #fffcf4;" class="text-center">{{ $departamentos->links() }}</td>
                                </tr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        // Obtener el elemento donde se mostrará la fecha
        var fechaElemento = document.getElementById('fecha');

        // Obtener el elemento donde se mostrará la hora
        var horaElemento = document.getElementById('hora');

        // Obtener la fecha y hora actual
        var fechaHoraActual = new Date();

        // Formatear la fecha
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        var fechaFormateada = fechaHoraActual.toLocaleDateString('es-ES', options);

        // Formatear la hora
        var horaFormateada = fechaHoraActual.toLocaleTimeString('es-ES');

        // Mostrar la fecha y la hora en los elementos correspondientes
        fechaElemento.textContent = 'Oaxaca a ' + fechaFormateada;
        horaElemento.textContent = 'Hora: ' + horaFormateada;
    </script>
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
                    {id: 'imagen'},
                    {id: 'nombre'},
                    {id: 'precio_renta'},
                    {id: 'descripcion'},
                    {id: 'acciones'},
                    
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
                text: "Departamento eliminado",
                icon: "success"
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.formulario-eliminar').submit(function(e) {
                e.preventDefault(); // Evitar el envío del formulario

                Swal.fire({
                    title: "¿Está seguro de eliminar el departamento?",
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
    
    
    <script>
        $(document).ready(function() {
            // Al hacer clic en la imagen, mostrarla en el modal
            $('.imagen-departamento').click(function() {
                var imagenSrc = $(this).data('imagen');
                $('#modalImagen').attr('src', imagenSrc);
            });
        });
    </script>

    @foreach ($departamentos as $departamento)
    <!-- Modal -->
    <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Imagen del departamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Cambios en el código HTML del modal-body -->
                <div class="modal-body" style="text-align: center;">
                    <img id="modalImagen" src="" alt="Imagen del departamento" style="max-width: 100%;">
                </div>
            </div>
        </div>
    </div>
    @endforeach   
</body>
@endsection