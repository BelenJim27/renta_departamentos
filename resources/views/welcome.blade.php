<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Renta de Departamentos</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fbe6e6; /* Rosa claro */
            color: #6b4d4d; /* Marrón claro */
        }

        /* Botón personalizado */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff80ab; /* Rosa */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #ff99bb; /* Rosa más claro al pasar el ratón */
        }

        /* Contenedor principal */
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding-top: 100px;
        }

        /* Encabezado */
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        /* Descripción */
        .description {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Renta de Departamentos</h1>
        <p class="description">Encuentra el departamento perfecto para ti.</p>
        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm">
                        <a href="{{ route('login') }}" class="btn-pink">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="btn-pink ml-4">Registrarse</a>
                    </div>
                </div>
    </div>
</body>
</html>
