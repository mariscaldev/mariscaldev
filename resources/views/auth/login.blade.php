<x-guest-layout>
    {{-- Ahora usamos h-screen para ajustar exactamente a la altura de la ventana y overflow-hidden --}}
    <div class="pb-8 overflow-hidden">

        {{-- Logo y texto, centrado horizontal pero con padding vertical para no centrar absolutamente --}}
        <div class="max-w-md mx-auto pt-16 pb-8 px-4 sm:px-6 lg:px-8 text-center">
            <a href="{{ url('/') }}" class="inline-block text-4xl font-extrabold">
                <span class="text-white">Mariscal</span><span class="text-[#FF0303]">Dev</span>
            </a>
            <p class="mt-2 text-gray-200">Bienvenido de nuevo, inicia sesión para continuar</p>
        </div>

        {{-- Formulario, centrado horizontal con padding --}}
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('login') }}"
                class="space-y-6 bg-white/10 backdrop-blur-md p-8 rounded-2xl shadow-xl">
                @csrf

                {{-- Email --}}
                <div class="relative">
                    <input id="email" name="email" type="email" required autofocus
                        placeholder="Correo electrónico"
                        class="block w-full px-4 py-3 rounded-lg bg-white/20 placeholder-gray-300 text-white
                        focus:outline-none focus:ring-2 focus:ring-[#1DDDF2] focus:border-transparent">
                    @error('email')
                        <p class="mt-2 text-sm text-[#730C02]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="relative">
                    <input id="password" name="password" type="password" required placeholder="Contraseña"
                        class="block w-full px-4 py-3 rounded-lg bg-white/20 placeholder-gray-300 text-white
                        focus:outline-none focus:ring-2 focus:ring-[#1DDDF2] focus:border-transparent">
                    @error('password')
                        <p class="mt-2 text-sm text-[#730C02]">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Recuérdame + Olvidé --}}
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded text-[#0F8DBF] focus:ring-[#1DDDF2]">
                        <span class="ml-2 text-sm text-gray-200">Recuérdame</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-medium text-[#0F8DBF] hover:text-[#1DDDF2]">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                {{-- Botón --}}
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 text-sm font-semibold
                         rounded-lg text-white bg-[#0F8DBF] hover:bg-[#1DDDF2]
                         focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1DDDF2]">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>
