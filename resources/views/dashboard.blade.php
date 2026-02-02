<x-app-layout>
    <x-slot name="header">
        <div style="width: 100%; display:flex; justify-content: center">
            <h2 class="font-bold text-xxl-center text-dark-emphasis">
                ¡¡¡BIENVENIDOS!!!
            </h2>
        </div>


    </x-slot>

    <div class="d-flex justify-content-center align-items-center min-vh" style="background-color: #ffffff;">
        <div class="row justify-content-center mb-5">
            <div class="col">
                <a href="{{ route('busqueda_paciente') }}" class="btn btn-lg py-4 text-white shadow-sm"
                   style="background: linear-gradient(135deg, #4e73df, #224abe);display:flex;justify-content: center ;align-items: center;width: 600px; height: 400px; border-radius: 12px; font-size: 1.7rem; transition: transform 0.2s ease;">
                    🔍 BUSCAR PACIENTE EXISTENTE
                </a>
            </div>
            <div class="col">
                <a href="{{ route('create_formulario') }}" class="btn btn-lg  py-4 text-white shadow-sm"
                   style="background: linear-gradient(135deg, #1cc88a, #17a673);display:flex;justify-content: center ;align-items: center; width: 600px; height: 400px;border-radius: 12px; font-size: 1.7rem; transition: transform 0.2s ease;">
                    ➕ REGISTRAR NUEVO PACIENTE
                </a>
            </div>
        </div>

        <style>
            a.btn:hover {
                transform: scale(1.03);
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
            }
        </style>
    </div>
</x-app-layout>
@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '¡Registro exitoso!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif
