{{-- resources/views/main/accesos-directos.blade.php --}}
@extends('layouts.app_blank')

@section('content')
    <header class="flex justify-end p-4">
        <a href="{{ url('/') }}"
           class="px-4 py-2 font-semibold bg-cornflower hover:bg-fluorescent rounded transition">
            Volver al inicio
        </a>
    </header>

    <main class="flex flex-col items-center mt-12 px-4">
        <h1 class="text-4xl font-bold mb-8">Accesos Directos</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-4xl">
            <a href="https://github.com/mariscaldev/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fab fa-github text-2xl mb-2"></i>
                <p class="mt-2">GitHub</p>
            </a>
            <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fas fa-envelope text-2xl mb-2"></i>
                <p class="mt-2">Gmail</p>
            </a>
            <a href="https://www.gmx.es/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fas fa-globe text-2xl mb-2"></i>
                <p class="mt-2">GMX</p>
            </a>
            <a href="https://www.linkedin.com/in/raulmariscaldev/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fab fa-linkedin text-2xl mb-2"></i>
                <p class="mt-2">LinkedIn</p>
            </a>
            <a href="https://www.reddit.com/user/mariscaldev/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fab fa-reddit text-2xl mb-2"></i>
                <p class="mt-2">Reddit</p>
            </a>
            <a href="https://twitter.com/MariscalDev/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fab fa-twitter text-2xl mb-2"></i>
                <p class="mt-2">Twitter</p>
            </a>
            <a href="https://www.youtube.com/" target="_blank"
               class="block p-6 bg-cornflower hover:bg-fluorescent rounded shadow text-center transition">
                <i class="fab fa-youtube text-2xl mb-2"></i>
                <p class="mt-2">YouTube</p>
            </a>
        </div>
    </main>
@endsection
