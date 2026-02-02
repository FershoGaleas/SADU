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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @if (isset($header))
        <header class="py-3">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="flex-grow-1 bg-white py-4">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
</div>
<footer>
    <div style="width:100%; text-align:center;">
        <span>Powered By FERSHO - Version 2.9 Beta </span>
    </div>
</footer>
</body>

</html>
