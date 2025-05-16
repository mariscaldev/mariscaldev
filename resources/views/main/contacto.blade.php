@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col lg:flex-row bg-gradient-to-r from-[#0A3B59] via-[#0F8DBF] to-[#0A3B59] text-white overflow-hidden">
  <!-- Sección de inspiración -->
  <div class="relative w-full lg:w-1/2 h-80 lg:h-screen flex items-center justify-center">
    <img src="{{ asset('assets/contact.png') }}" alt="Contáctame" class="absolute inset-0 w-full h-full object-cover opacity-80">
    <div class="relative p-8 bg-black bg-opacity-50 rounded-xl max-w-md text-center space-y-4">
      <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg">Transforma tu visión en arte</h1>
      <p class="text-lg md:text-xl">Creaciones únicas que cuentan tu historia. ¡Haz que tu marca destaque!</p>
      <span class="inline-block px-4 py-2 bg-[#1DDDF2] text-[#0A3B59] font-bold rounded-full animate-pulse">¡Diseños geniales que inspiran!</span>
    </div>
  </div>

  <!-- Formulario inspirador -->
  <div class="w-full lg:w-1/2 bg-[#0A3B59] p-6 lg:p-16 flex items-center justify-center">
    <div class="max-w-lg w-full space-y-6">
      <h2 class="text-3xl md:text-4xl font-bold text-[#F2490C] text-center">Hablemos de tu próximo proyecto</h2>
      <p class="text-white/80 text-center">¿Listo para impulsar tu negocio con un diseño que conecte?</p>
      <form id="contactForm" class="space-y-5" onsubmit="return enviarFormulario(event)">
        @csrf
        <!-- Nombre -->
        <div class="flex flex-col">
          <label for="nombre" class="text-sm font-medium text-white/80">Nombre *</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required
            class="mt-1 p-3 bg-white/10 rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-[#F2490C] transition" />
        </div>

        <!-- Correo -->
        <div class="flex flex-col">
          <label for="email" class="text-sm font-medium text-white/80">Correo Electrónico *</label>
          <input type="email" id="email" name="email" placeholder="tuemail@ejemplo.com" required
            class="mt-1 p-3 bg-white/10 rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-[#F2490C] transition" />
        </div>

        <!-- Teléfono & Asunto -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="flex flex-col">
            <label for="telefono" class="text-sm font-medium text-white/80">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="+56 9 1234 5678"
              class="mt-1 p-3 bg-white/10 rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-[#F2490C] transition" />
          </div>
          <div class="flex flex-col">
            <label for="asunto" class="text-sm font-medium text-white/80">Asunto</label>
            <input type="text" id="asunto" name="asunto" placeholder="¿En qué puedo ayudarte?"
              class="mt-1 p-3 bg-white/10 rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-[#F2490C] transition" />
          </div>
        </div>

        <!-- Comentario -->
        <div class="flex flex-col">
          <label for="comentario" class="text-sm font-medium text-white/80">Mensaje *</label>
          <textarea id="comentario" name="comentario" rows="4" placeholder="Cuéntame sobre tu proyecto..." required
            class="mt-1 p-3 bg-white/10 rounded-lg text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-[#F2490C] transition"></textarea>
        </div>

        <!-- Botón de acción -->
        <div>
          <button type="submit"
            class="w-full py-3 bg-[#F2490C] font-bold rounded-lg hover:bg-[#1DDDF2] hover:text-[#0A3B59] transition-all transform hover:scale-105">
            ¡Empecemos!</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal de feedback -->
  <div id="modal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 p-4">
    <div class="bg-[#0F8DBF] rounded-xl p-8 max-w-sm w-full text-center space-y-4 relative">
      <div id="modalContent"></div>
      <button onclick="cerrarModal()"
        class="absolute top-4 right-4 text-white"><i class="fas fa-times"></i></button>
      <button onclick="cerrarModal()" class="mt-4 px-6 py-2 bg-[#F2490C] text-white rounded-full hover:bg-[#1DDDF2] transition">Cerrar</button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function enviarFormulario(e) {
    e.preventDefault();
    const modal = document.getElementById('modal');
    const content = document.getElementById('modalContent');
    modal.classList.remove('hidden');
    content.innerHTML = '<div class="loader mx-auto"></div>';

    const data = {
      nombre: document.getElementById('nombre').value,
      email: document.getElementById('email').value,
      telefono: document.getElementById('telefono').value,
      asunto: document.getElementById('asunto').value,
      comentario: document.getElementById('comentario').value,
    };

    fetch('https://api-correos.mariscaldev.cl/.netlify/functions/sendEmail', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    })
    .then(res => {
      if (res.ok) {
        content.innerHTML = `
          <svg class="w-16 h-16 mx-auto text-[#F2490C]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <p class="mt-4 font-semibold">¡Tu mensaje se envió con éxito!</p>
        `;
      } else throw new Error();
    })
    .catch(() => {
      content.innerHTML = `
        <svg class="w-16 h-16 mx-auto text-[#730C02]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <p class="mt-4 font-semibold">Hubo un problema al enviar tu mensaje.</p>
      `;
    });
  }

  function cerrarModal() {
    document.getElementById('modal').classList.add('hidden');
  }
</script>
<style>
  .loader {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border-top: 4px solid #FFF;
    border-right: 4px solid transparent;
    animation: spin 1s linear infinite;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endsection
