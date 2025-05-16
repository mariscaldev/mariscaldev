<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- ICONOS PARA SOBRE-MI Y OTROS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter bg-prussian text-white">
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('ui', {
                modalAbierto: false
            });
        });
    </script>

    @if (session('success'))
        <div class="fixed top-5 right-5 bg-cornflower text-white px-4 py-2 rounded shadow z-50 animate-fadeInUp">
            {{ session('success') }}
        </div>
    @endif

    <div x-data="{ sidebarOpen: false }" class="h-screen flex flex-col lg:flex-row relative">

        <!-- Mobile Header -->
        <div class="bg-prussian lg:hidden flex items-center justify-between p-4">
            <h1 class="text-white text-xl font-bold">Mariscal<span class="text-orioles">Dev</span></h1>
            <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none" aria-label="Abrir menú">
                <span class="material-icons text-3xl">menu</span>
            </button>
        </div>

        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-prussian to-cornflower text-white z-50 transform transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <nav class="flex flex-col h-full justify-between py-6">

                <!-- Superior: Avatar y saludo -->
                <div class="flex flex-col items-center px-4">
                    @auth
                        <img src="{{ asset('assets/profile.png') }}" alt="Avatar"
                            class="w-20 h-20 rounded-full border-2 border-fluorescent mb-3 shadow-md">
                        <p class="text-sm text-gray-300 text-center leading-snug mb-4">
                            Bienvenido, <span class="font-semibold text-orioles">{{ Auth::user()->name }}</span>
                        </p>
                    @endauth
                </div>

                <!-- Centro: Menú -->
                <div class="flex-1 px-4 overflow-y-auto flex flex-col justify-center items-center">
                    <ul class="space-y-10 text-center">
                        @auth
                            <li>
                                <a href="{{ route('accesos') }}"
                                    class="flex items-center justify-start p-2 rounded-md w-44 mx-auto space-x-3 {{ request()->routeIs('accesos') ? 'bg-orioles' : 'hover:bg-orioles' }}">
                                    <span class="material-icons text-xl">home</span>
                                    <span class="text-sm">Accesos Directos</span>
                                </a>
                            </li>
                        @endauth

                        <li>
                            <a href="{{ route('sobre-mi') }}"
                                class="flex items-center justify-start p-2 rounded-md w-44 mx-auto space-x-3 {{ request()->routeIs('sobre-mi') ? 'bg-orioles' : 'hover:bg-orioles' }}">
                                <span class="material-icons text-xl">face</span>
                                <span class="text-sm">SOBRE MÍ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('proyectos') }}"
                                class="flex items-center justify-start p-2 rounded-md w-44 mx-auto space-x-3 {{ request()->routeIs('proyectos') ? 'bg-orioles' : 'hover:bg-orioles' }}">
                                <span class="material-icons text-xl">work</span>
                                <span class="text-sm">PROYECTOS</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contacto') }}"
                                class="flex items-center justify-start p-2 rounded-md w-44 mx-auto space-x-3 {{ request()->routeIs('contacto') ? 'bg-orioles' : 'hover:bg-orioles' }}">
                                <span class="material-icons text-xl">mail</span>
                                <span class="text-sm">CONTACTO</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Inferior: Cerrar sesión -->
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="px-4">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center mx-auto p-2 rounded-md w-44 bg-barn hover:bg-red-800 text-sm font-semibold">
                            <span class="material-icons text-xl mr-2">logout</span> Cerrar sesión
                        </button>
                    </form>
                @endauth
            </nav>
        </aside>


        <!-- Main Content -->
        <main x-data
            :class="{
                'overflow-hidden h-screen': $store.ui.modalAbierto,
                'overflow-y-auto': !$store.ui.modalAbierto && $el.scrollHeight > $el.clientHeight
            }"
            class="flex-1 bg-prussian lg:ml-64 transition-all duration-500 min-h-screen">

            @isset($header)
                <header class="mb-6 border-b border-fluorescent pb-4">
                    <h2 class="text-3xl font-semibold">{{ $header }}</h2>
                </header>
            @endisset

            <livewire:dynamic-content />
        </main>
    </div>

    <script src="https://unpkg.com/alpinejs" defer></script>

    @livewireScripts
    @livewireStyles
</body>

</html>
