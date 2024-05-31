
@extends('layouts.app')

@section('content')
<body style="background-color: #FEFAF6;">
    <section class="section">
        <div class="section-header" style="background-color: #FEFAF6; margin-top: 50px;display: flex; justify-content: center; align-items: center;color: black;font-family: 'Trebuchet MS';">
            <h3 class="page__heading">Departamento</h3>
        </div>
        <!-- Agregar el formulario de filtro -->
        <div class="row justify-content-center mb-3">
            <div class="col-lg-6">
                <form action="{{ route('departamentos.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="min_price" class="form-control" placeholder="Precio mínimo">
                        <input type="text" name="max_price" class="form-control" placeholder="Precio máximo">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Fin del formulario de filtro -->
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
                                <table class="table table-striped mt-2" id="miTabla3" style="background-color: #fcf3f7; border-color: white; box-shadow: 3px 3px 6px rgba(.5, .5, .5, .5);">
                                    <thead style="background-color: #DAC0A3;">
                                        <tr style="background-color: #DAC0A3; border-color: #605c8c; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
                                            <th style="display: none;">Id</th>
                                            <th style="color: #fff; width: 10%;">Imagen</th>
                                            
                                            <th style="color: #fff; width: 5%;">Precio Renta</th>
                                            <th style="color: #fff; width: 10%;">Direccion</th>
                                            <th style="color: #fff; width: 30%;">Descripcion</th>
                                            <th style="color: #fff; width: 10%;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departamentos as $departamento)
                                            <tr>
                                                <td style="display: none;">{{ $departamento->id }}</td>
                                                <td style="width: 10%;">
                                                <img src="{{ Storage::url($departamento->imagen) }}" alt="Imagen del departamento" width="100" height="100" class="imagen-departamento" data-toggle="modal" data-target="#imagenModal" data-imagen="{{ Storage::url($departamento->imagen) }}">
                                                </td>

                                                <td style="width: 5%;">{{ $departamento->disponibilidad }}</td>
                                                <td style="width: 5%;">${{ number_format($departamento->precio_renta, 2, '.', ',') }}</td>
                                                <td style="width: 10%;">Calle {{ $departamento->Domicilio->calle }} #{{ $departamento->Domicilio->numero }},Colonia {{ $departamento->Domicilio->colonia }}</td>
                                                <td style="width: 30%;">{{ $departamento->descripcion }}</td>
                                                
                                                <td style="width: 10%; padding: 10px;"> <!-- Aquí también agregué el padding -->
                                                @if (Gate::check('editar-departamento', $departamento))
                                                        <a href="{{ route('departamentos.edit', $departamento->id) }}" class="btn btn-primary mr-2" title="Editar Departamento">Editar</a>
                                                    @endif

                                                    @if (Gate::check('borrar-departamento', $departamento))
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['departamentos.destroy', $departamento->id], 'class'=>'formulario-eliminar','style' => 'display:inline']) !!}
                                                            <button type="submit" class="btn btn-danger mr-2" title="Borrar departamento">Borrar</button>
                                                        {!! Form::close() !!}
                                                    @endif

                                                    <a href="/rentar" class="btn btn-secondary" title="Apartar departamento">Apartar</a>


                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <tr>
                                    <td colspan="8" style="background-color: #fffcf4;" class="text-center">{{ $departamentos->links() }}</td>
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
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#miTabla3').DataTable({
                lengthMenu: [
                    [2, 5, 10],
                    [2, 5, 10]
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json',
                }
            });
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
<script>
        function formatSpanishDate(date) {
            const months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            
            let day = date.getDate();
            let month = date.getMonth(); // Los meses van de 0 a 11
            let year = date.getFullYear();
            
            return `${day} de ${months[month]} del ${year}`;
        }

        // Fecha actual
        let currentDate = new Date();
        
        // Formatear la fecha en el formato deseado
        let formattedDate = formatSpanishDate(currentDate);

        // Mostrar la fecha formateada en el HTML
        document.getElementById('date-output').textContent = formattedDate;
    </script>

@foreach ($departamento as $departamento)
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
