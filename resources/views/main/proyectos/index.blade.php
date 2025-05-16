@extends('layouts.app')

@section('content')
    <div x-data="{
        // Local state
        modalAbierto: false,
        rebotarModal: false,
        proyectos: {{ Js::from($proyectos) }},
        currentPage: 1,
        itemsPerPage: 4,
        seleccionado: {{ Js::from($proyectos[0]) }},
        seleccionar(p) { this.seleccionado = p; },
        abrirModal() {
            this.modalAbierto = true;
            this.rebotarModal = false;
        },
        cerrarModal() { this.modalAbierto = false; },
        get paginated() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.proyectos.slice(start, start + this.itemsPerPage);
        },
        get totalPages() {
            return Math.ceil(this.proyectos.length / this.itemsPerPage);
        }
    }" x-effect="document.body.classList.toggle('overflow-hidden', modalAbierto)"
        class="min-h-screen grid grid-rows-[3fr_2fr] bg-prussian text-white relative pb-4">

        <!-- Top: Destacado -->
        <div class="row-span-3 grid grid-cols-12 gap-4 md:gap-6 items-center px-4 md:px-8">
            <div class="col-span-12 lg:col-span-6 flex justify-center">
                <div class="w-full max-w-md md:max-w-lg h-48 md:h-64 lg:h-80 rounded-2xl overflow-hidden shadow-lg">
                    <img :src="'/storage/' + seleccionado.imagen" alt="Proyecto"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6 space-y-3 md:space-y-4">
                <p class="uppercase text-xs tracking-widest text-fluorescent-blue" x-text="seleccionado.fecha.split('-')[0]">
                </p>
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold" x-text="seleccionado.titulo"></h1>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed line-clamp-3"
                    x-text="seleccionado.descripcion"></p>
                <div class="flex items-center space-x-2">
                    <img :src="'/storage/' + seleccionado.img_creador" alt="Creador"
                        class="w-10 h-10 rounded-full ring-2 ring-cornflower object-cover" />
                    <p class="text-sm text-gray-200" x-text="seleccionado.creador"></p>
                </div>
                <button @click="abrirModal"
                    class="mt-3 inline-block bg-orioles hover:bg-[#d63f06] text-white font-semibold px-4 md:px-6 py-2 md:py-3 rounded-lg shadow-lg transition transform hover:scale-105">
                    Ver Proyecto
                </button>
                @auth
                    <div class="text-right">
                        <a href="{{ route('proyectos.agregar') }}"
                            class="inline-flex items-center bg-cornflower hover:bg-fluorescent-blue text-white font-semibold px-3 md:px-4 py-1 md:py-2 rounded-md shadow transition transform hover:scale-105">
                            <i class="material-icons mr-1 text-base">add_circle</i>
                            <span class="text-sm">Agregar Proyecto</span>
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Bottom: Lista -->
        <div class="row-span-2 px-4 md:px-8 pt-4">
            <h2 class="text-xl md:text-2xl font-bold text-center mb-4 md:mb-6">Proyectos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <template x-for="(proyecto,index) in paginated" :key="index">
                    <div @click="seleccionar(proyecto)"
                        class="bg-cornflower hover:bg-fluorescent-blue p-3 rounded-lg shadow-md cursor-pointer transition transform hover:scale-105 flex flex-col items-center">
                        <img :src="'/storage/' + proyecto.imagen" alt="Proyecto"
                            class="w-full h-28 md:h-32 object-cover rounded-md mb-2" />
                        <p class="text-sm md:text-base font-medium text-white text-center line-clamp-2"
                            x-text="proyecto.titulo"></p>
                    </div>
                </template>
            </div>

            <!-- Paginación -->
            <div class="flex justify-center mt-4">
                <template x-for="page in totalPages" :key="page">
                    <button @click="currentPage = page"
                        class="px-2 py-1 mx-1 rounded-md text-sm md:text-base transition-all"
                        :class="{
                            'bg-orioles text-white': currentPage === page,
                            'bg-prussian text-gray-400 hover:bg-cornflower': currentPage !== page
                        }">
                        <span x-text="page"></span>
                    </button>
                </template>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="modalAbierto" x-transition.opacity
            class="fixed inset-0 z-50 flex items-start justify-center bg-prussian bg-opacity-90 backdrop-blur-sm pt-12 px-4"
            @click.self="rebotarModal = true" @keydown.escape.window="cerrarModal()" style="display:none;">
            <div x-show="modalAbierto" :class="{ 'animate-bounce': rebotarModal }" @animationend="rebotarModal=false"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                class="relative bg-white/10 text-white rounded-2xl shadow-2xl w-full max-w-md sm:max-w-lg lg:max-w-2xl max-h-[80vh] overflow-y-auto p-6 border border-white/20 backdrop-blur-lg backdrop-saturate-150 ring-1 ring-fluorescent">

                <button @click="cerrarModal()"
                    class="absolute top-3 right-4 text-fluorescent hover:text-barn text-2xl font-bold focus:outline-none">
                    &times;
                </button>

                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-6 h-6 text-cornflower" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
                    </svg>
                    <h2 class="text-xl md:text-2xl font-bold" x-text="seleccionado.titulo"></h2>
                </div>
                <p class="text-sm text-gray-400 mb-4" x-text="seleccionado.fecha.split('-')[0]"></p>
                <img :src="'/storage/' + seleccionado.imagen" alt="Imagen del proyecto"
                    class="rounded-lg w-full h-48 md:h-56 object-cover shadow mb-4" />
                <p class="text-gray-300 text-sm md:text-base leading-relaxed whitespace-pre-line mb-2 line-clamp-5"
                    x-text="seleccionado.descripcion"></p>
                <button @click="rebotarModal = !rebotarModal"
                    class="mt-2 text-cornflower hover:text-fluorescent text-sm font-semibold focus:outline-none">
                    <span x-text="rebotarModal ? 'Ver menos' : 'Ver más'"></span>
                </button>
                <div class="flex flex-col sm:flex-row items-center justify-between mt-6 gap-4">
                    <div class="flex items-center gap-2">
                        <img :src="'/storage/' + seleccionado.img_creador" alt="Creador"
                            class="w-8 h-8 rounded-full object-cover border border-white/30">
                        <p class="text-sm" x-text="seleccionado.creador"></p>
                    </div>
                    <template x-if="seleccionado.url_proyecto">
                        <a :href="seleccionado.url_proyecto" target="_blank"
                            class="bg-cornflower hover:bg-fluorescent-blue text-white font-semibold px-4 py-2 rounded-md shadow transition-transform hover:scale-105">
                            Ir al proyecto
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection
