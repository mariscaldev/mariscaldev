<div x-data="{ animate: false }" x-init="animate = true"
     x-bind:class="animate ? 'animate-fadeInUp' : ''"
     class="transition-all duration-500">

    @yield('content') {{-- Aquí cargas el contenido de cada página --}}
</div>
