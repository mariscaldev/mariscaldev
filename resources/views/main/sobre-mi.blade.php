@extends('layouts.app')

@section('content')
<div class="relative bg-prussian text-white px-8 p-6 pt-8 flex items-center overflow-hidden">
  <!-- Background Decorative Circles -->
  <div class="absolute -top-32 -left-32 w-72 h-72 bg-fluorescent opacity-10 rounded-full"></div>
  <div class="absolute -bottom-32 -right-32 w-72 h-72 bg-cornflower opacity-10 rounded-full"></div>

  <div class="relative w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

    <!-- Texto -->
    <div class="space-y-6 text-center md:text-left">
      <p class="text-orioles font-semibold uppercase text-sm hover:tracking-wider transition-all duration-300">
        Bienvenido a mi mundo
      </p>

      <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight">
        Hola, soy
        <span class="text-orioles relative inline-block group">
          Raúl Mariscal
          <span class="absolute bottom-0 left-0 w-full h-1 bg-orioles scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-500"></span>
        </span>
      </h1>

      <h2 class="text-2xl sm:text-3xl font-medium text-gray-300">
        Ingeniero Informático • Desarrollador Fullstack
      </h2>

      <p class="text-gray-300 max-w-lg mx-auto md:mx-0 text-base leading-relaxed">
        Apasionado por el diseño de interfaces y la experiencia de usuario. Creo soluciones innovadoras
        combinando tecnología y diseño para simplificar procesos y cautivar a los usuarios.
      </p>

      <!-- Redes Sociales -->
      <div class="pt-6">
        <h3 class="text-gray-400 uppercase text-xs font-semibold mb-2">Encuéntrame aquí</h3>
        <div class="flex justify-center md:justify-start space-x-6 text-3xl">
          @php
            $socials = [
              ['url' => 'https://x.com/MariscalDev', 'icon' => 'fab fa-twitter'],
              ['url' => 'https://github.com/mariscaldev', 'icon' => 'fab fa-github'],
              ['url' => 'https://www.linkedin.com/in/raulmariscaldev/', 'icon' => 'fab fa-linkedin'],
            ];
          @endphp
          @foreach($socials as $social)
            <a href="{{ $social['url'] }}" target="_blank" class="group hover:text-orioles transition-colors">
              <i class="{{ $social['icon'] }}"></i>
            </a>
          @endforeach
        </div>
      </div>

      <!-- Tecnologías -->
      <div class="pt-10">
        <h3 class="text-gray-400 uppercase text-xs font-semibold mb-4">Tecnologías que domino</h3>
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-8 justify-items-center">
          @php
            $techs = [
              ['icon' => 'fab fa-angular', 'name' => 'Angular'],
              ['icon' => 'fab fa-mobile-screen-button', 'name' => 'Ionic'],
              ['icon' => 'fab fa-html5', 'name' => 'HTML'],
              ['icon' => 'fab fa-css3-alt', 'name' => 'CSS'],
              ['icon' => 'fas fa-swatchbook', 'name' => 'SCSS'],
              ['icon' => 'fab fa-laravel', 'name' => 'Laravel'],
              ['icon' => 'fab fa-js-square', 'name' => 'JavaScript'],
              ['icon' => 'fas fa-code', 'name' => 'TypeScript'],
              ['icon' => 'fab fa-linux', 'name' => 'Linux'],
              ['icon' => 'fab fa-windows', 'name' => 'Windows'],
            ];
          @endphp
          @foreach($techs as $tech)
            <div class="group flex flex-col items-center cursor-pointer">
              <i class="{{ $tech['icon'] }} text-fluorescent text-4xl group-hover:text-orioles group-hover:scale-110 transform transition duration-300"></i>
              <span class="text-sm mt-1 text-gray-300 group-hover:text-white transition-colors duration-300">{{ $tech['name'] }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Imagen -->
    <div class="flex justify-center md:justify-end">
      <div class="group relative w-80 h-80 md:w-96 md:h-96 rounded-full overflow-hidden shadow-2xl transform transition duration-500 hover:scale-105 hover:rotate-3">
        <img src="{{ asset('assets/profile.png') }}" alt="Raúl Mariscal" class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-t from-prussian/60 to-transparent opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
      </div>
    </div>

  </div>
</div>
@endsection
