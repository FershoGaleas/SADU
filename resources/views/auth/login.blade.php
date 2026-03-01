<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('favicon') }}">

    <!-- Estilos personalizados -->
    <style>

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #037015, #4DBD50, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-box {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            border-color: #0d6efd;
        }

        .logo-img {
            height: 80px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="login-box text-center align-items-center">

            <!-- Logo -->
            <img src="{{ asset('build/assets/original_medicina.png') }}" alt="Logo" width="300px" height="300px">

            <!-- Mensaje de sesión -->
            @if(session('status'))
                <div class="alert alert-info text-center mb-4">
                    {{ session('status') }}
                </div>
            @endif


            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Identidad -->
                <div class="mb-3 text-start">
                    <label for="identidad" class="form-label">Identidad</label>
                    <input type="text" name="identidad" id="identidad" class="form-control shadow-sm" value="{{ old('identidad') }}" required autofocus autocomplete="username">
                    @error('identidad')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control shadow-sm" required autocomplete="current-password">
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                

                <!-- Botón de login -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary shadow-sm m-4">
                        Iniciar Sesión
                    </button>
                </div>
                
            </form>
            
                <div class="text-center">
                    <p>--Versión 2.9.1 Beta--</p>        
                </div>
            
            
        </div>
    </div>

</body>
</html>