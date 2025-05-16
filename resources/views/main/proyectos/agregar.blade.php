@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-12 bg-prussian p-10 rounded-2xl shadow-xl border border-fluorescent">
        <h2 class="text-3xl font-bold text-white mb-10 text-center">Agregar Proyecto</h2>

        <form action="{{ route('proyectos.store') }}" method="POST" enctype="multipart/form-data" id="formProyecto">
            @csrf

            @if ($errors->any())
                <div class="bg-barn text-white p-4 rounded-lg mb-6">
                    <p class="font-bold">Errores al guardar el proyecto:</p>
                    <ul class="list-disc list-inside text-sm mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Título</label>
                    <div class="relative">
                        <i class="fas fa-heading absolute left-3 top-2.5 text-fluorescent"></i>
                        <input type="text" name="titulo"
                            class="w-full pl-10 rounded-md bg-white/10 text-white border border-fluorescent focus:ring-fluorescent focus:border-fluorescent px-3 py-2">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Fecha</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-3 top-2.5 text-fluorescent"></i>
                        <input type="date" name="fecha"
                            class="w-full pl-10 rounded-md bg-white/10 text-white border border-fluorescent focus:ring-fluorescent focus:border-fluorescent px-3 py-2">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-white mb-1">Descripción</label>
                    <textarea name="descripcion" rows="4"
                        class="w-full rounded-md bg-white/10 text-white border border-fluorescent focus:ring-fluorescent focus:border-fluorescent px-3 py-2"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Imagen del Proyecto</label>
                    <input type="file" name="imagen" accept="image/*" class="text-white text-sm"
                        onchange="previewImage(event, 'previewProyecto')">
                    <p class="text-xs text-gray-400 mt-1">Máximo 10MB. JPG o PNG.</p>
                    <img id="previewProyecto" class="mt-2 rounded shadow max-h-40 hidden" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Imagen del Creador</label>
                    <input type="file" name="img_creador" accept="image/*" class="text-white text-sm"
                        onchange="previewImage(event, 'previewCreador')">
                    <p class="text-xs text-gray-400 mt-1">Máximo 10MB. JPG o PNG.</p>
                    <img id="previewCreador" class="mt-2 rounded shadow max-h-40 hidden" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-1">Creador</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-2.5 text-fluorescent"></i>
                        <input type="text" name="creador" value="{{ Auth::user()->name }}"
                            class="w-full pl-10 rounded-md bg-white/10 text-white border border-fluorescent focus:ring-fluorescent focus:border-fluorescent px-3 py-2">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-white mb-1">URL del proyecto (opcional)</label>
                    <div class="relative">
                        <i class="fas fa-link absolute left-3 top-2.5 text-fluorescent"></i>
                        <input type="url" name="url_proyecto"
                            class="w-full pl-10 rounded-md bg-white/10 text-white border border-fluorescent focus:ring-fluorescent focus:border-fluorescent px-3 py-2">
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <button type="submit"
                    class="bg-orioles hover:bg-[#d63f06] text-white px-8 py-3 rounded-lg font-semibold shadow-md transition duration-300">
                    Guardar Proyecto
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Cargando -->
    <div id="modalCargando" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center hidden">
        <div class="bg-prussian text-white px-8 py-6 rounded-xl text-center border border-fluorescent animate-pulse">
            <p class="text-lg font-semibold mb-2">Agregando proyecto...</p>
            <i class="fas fa-spinner fa-spin text-3xl text-fluorescent"></i>
        </div>
    </div>

    <!-- Modal Éxito -->
    <div id="modalExito" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center hidden">
        <div class="bg-prussian text-white px-8 py-6 rounded-xl text-center border border-fluorescent">
            <p class="text-lg font-semibold mb-2">¡Proyecto agregado correctamente!</p>
            <i class="fas fa-check-circle text-4xl text-fluorescent mb-4"></i>
            <button onclick="window.location.href='{{ route('proyectos') }}'"
                class="mt-2 bg-fluorescent hover:bg-cyan-400 text-prussian px-6 py-2 rounded-lg font-semibold">Continuar</button>
        </div>
    </div>

    <script>
        function previewImage(event, idPreview) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(idPreview);
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('formProyecto').addEventListener('submit', function(e) {
            const maxSizeMB = 10;
            const maxSizeBytes = maxSizeMB * 1024 * 1024;

            const imagen = document.querySelector('input[name="imagen"]')?.files[0];
            const imgCreador = document.querySelector('input[name="img_creador"]')?.files[0];

            let error = '';

            if (imagen && imagen.size > maxSizeBytes) {
                error += `• La imagen del proyecto supera los ${maxSizeMB}MB\n`;
            }

            if (imgCreador && imgCreador.size > maxSizeBytes) {
                error += `• La imagen del creador supera los ${maxSizeMB}MB\n`;
            }

            if (error) {
                e.preventDefault();
                alert("Errores al subir archivos:\n" + error);
            } else {
                document.getElementById('modalCargando').classList.remove('hidden');
            }
        });

        @if (session('success'))
            window.addEventListener('load', () => {
                document.getElementById('modalExito').classList.remove('hidden');
            });
        @endif
    </script>
@endsection
