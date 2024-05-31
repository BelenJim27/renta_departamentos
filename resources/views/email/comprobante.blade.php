<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Renta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            background-color: #f2f2f2;
            padding: 10px;
        }
        .section p {
            margin: 0;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Comprobante de Renta</h1>
            <p>Fecha: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>

        <div class="section">
            <h3>Datos del Inquilino</h3>
            <p>Nombre: {{ $renta->user->name }} {{ $renta->user->apellido_p }} {{ $renta->user->apellido_m }}</p>
            <p>Email: {{ $renta->user->email }}</p>
            <p>Teléfono: {{ $renta->user->phone_number }}</p>
        </div>

        <div class="section">
            <h3>Datos del Departamento</h3>
            <p>Dirección: Calle {{ $domicilio->calle }} #{{ $domicilio->numero }}, Colonia {{ $domicilio->colonia }}</p>
            <p>Descripción: {{ $departamento->descripcion }}</p>
            <p>Precio de Renta: ${{ number_format($departamento->precio_renta, 2, '.', ',') }}</p>
        </div>

        <div class="section">
            <h3>Detalles de la Renta</h3>
            <p>Periodo: {{ $renta->periodo }}</p>
            <p>Fecha de Inicio: {{ \Carbon\Carbon::parse($renta->fecha_ini)->format('d/m/Y') }}</p>
            <p>Fecha de Fin: {{ \Carbon\Carbon::parse($renta->fecha_fin)->format('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
