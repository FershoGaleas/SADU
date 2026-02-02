<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: white;
        }
    </style>
</head>
<body>
    {{-- Navegación --}}
        @include('layouts.navigation')
    <div class="container-fluid min-vh-100 d-flex flex-column">

        

        {{-- Encabezado de página --}}
        @if (isset($header))
            <header class="bg-white shadow-sm border-bottom">
                <div class="container py-4 px-3">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- Contenido principal --}}
        <main class="flex-grow-1 bg-white py-4">
            <div class="container">
                {{ $slot }}
            </div>
        </main>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const edadValor = document.getElementById('edad_valor');
            const edadUnidad = document.getElementById('edad_unidad');
        
            edadUnidad.addEventListener('change', function () {
                const unidad = this.value;
        
                if (unidad === 'meses') {
                    edadValor.setAttribute('max', '11');
                    edadValor.setAttribute('placeholder', 'Ej: 3');
                } else if (unidad === 'días') {
                    edadValor.setAttribute('max', '30');
                    edadValor.setAttribute('placeholder', 'Ej: 15');
                } else {
                    edadValor.removeAttribute('max');
                    edadValor.setAttribute('placeholder', 'Ej: 25');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputIdentidad = document.querySelector('input[name="identidad"]');
            if (!inputIdentidad) return;
        
            const feedback = document.createElement('div');
            feedback.classList.add('mt-1');
            inputIdentidad.parentNode.appendChild(feedback);
        
            let timeout = null;
        
            inputIdentidad.addEventListener('input', function () {
                clearTimeout(timeout);
                const valor = this.value.trim();
        
                if (valor.length >= 13) {
                    timeout = setTimeout(() => {
                        fetch(`/verificar-identidad?identidad=${valor}`)
                            .then(res => res.json())
                            .then(data => {
                                if (data.existe) {
                                    feedback.innerHTML = `<small class="text-danger">⚠️ Este número de identidad ya está registrado.</small>`;
                                } else {
                                    feedback.innerHTML = `<small class="text-success">✔️ Identidad disponible.</small>`;
                                }
                            })
                            .catch(() => {
                                feedback.innerHTML = `<small class="text-warning">Error al verificar identidad.</small>`;
                            });
                    }, 500);
                } else {
                    feedback.innerHTML = '';
                }
            });
        });
    </script>
</body>
<footer>
    <div style="width:100%; text-align:center;">
        <span>Powered By FERSHO - Version 2.9 Beta </span>
    </div>
</footer>
</html>