<template>
    <div class="min-h-screen bg-gray-50 flex flex-col">
        <header class="fixed top-0 left-0 w-full z-40 bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- <div class="grid grid-cols-3 items-center h-20"> -->
                <div class="grid grid-cols-[1fr_auto_1fr] items-center h-20">
                    <div class="flex items-center">
                        <!-- <Link
                            :href="route().has('public.escuela') ? route('public.escuela', { slug: currentSlug }) : '/'"
                            class="flex items-center gap-3"
                        > -->
                        <Link
                            :href="`/escuela/${currentSlug}`"
                            class="flex items-center gap-3"
                        >
                            <img
                                :src="logoUrl"
                                alt="Logo"
                                class="h-12 w-auto mb-4"
                            />
                            <span class="hidden text-sm font-bold text-gray-800 sm:inline whitespace-normal leading-tight max-w-[280px]">
                                {{ currentSchool?.name ?? app.faculty_name ?? 'Escuela Profesional' }}
                            </span>
                        </Link>
                    </div>
                    <nav class="hidden md:flex items-center gap-6 text-md font-medium text-gray-800 col-start-2">
                        <Link
                            :href="`/escuela/${currentSlug}`"
                            class="hover:text-gray-500">Inicio</Link>
                        <Link :href="`/escuela/${currentSlug}/nosotros`" class="hover:text-gray-500">Nosotros</Link>
                        <div class="relative">
                            <button @click="escuelasOpen=!escuelasOpen" class="flex items-center gap-1 hover:text-gray-500 focus:outline-none">
                                Programas
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform" :class="{'rotate-180': escuelasOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div v-if="escuelasOpen" class="absolute left-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 w-max" :class="escuelasMaxClass">
                                <div v-for="(item, index) in escuelasData" :key="index" class="py-1">
                                    <Link :href="`/escuela/${item.slug}/programa`" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 whitespace-normal break-words" @click="closeEscuelas">
                                        {{ item.name }}
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <Link :href="`/escuela/${currentSlug}/publicaciones`" class="hover:text-gray-500">Publicaciones</Link>
                        <Link :href="`/escuela/${currentSlug}/documentos`" class="hover:text-gray-500">Documentos</Link>
                    </nav>

                    <div class="flex items-center justify-end">
                        <img
                            src="https://certificados.webicacit.com/images/logo_icacit.png"
                            alt="Logo" class="h-6 w-auto mb-4"
                        />
                    </div>

                    <div class="flex items-center md:hidden" v-if="!mobileOpen">
                        <button
                            type="button"
                            @click="toggleMobile"
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-white"
                        >
                            <span class="sr-only">Abrir menú principal</span>
                            <svg
                                class="h-6 w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- CTA -->
                    <!-- <div class="hidden md:flex items-center justify-end col-start-3">
                        <PrimaryButton>Noticias OTI</PrimaryButton>
                         <a href="/" class="bg-blue-600 px-2 border rounded text-white hover:bg-blue-500">Ir a facultad</a>
                    </div> -->
                </div>
            </div>
        </header>
        <div v-if="mobileOpen" class="fixed inset-0 z-50 md:hidden">
            <div class="absolute inset-0 bg-gray-700" @click="toggleMobile"></div>
            <div class="relative flex h-full w-full max-w-xs flex-col bg-white shadow-xl">
                <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <img :src="logo" alt="Logo UNAP" class="h-9 w-auto"/>
                        <span class="text-sm font-semibold text-gray-700">MENÚ</span>
                    </div>
                    <button @click="toggleMobile" type="button" class="rounded -md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:fing-indigo-500">
                        <svg
                            class="h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 overflow-y-auto">
                    <ul class="text-sm font-medium text-gray-800">
                        <li>
                            <Link :href="'/'" class="block border-gray-100 px-4 py-3 hoer:b-gray-50">Inicio</Link>
                        </li>
                        <li>
                            <Link :href="`/escuela/${currentSlug}/nosotros`" class="block border-b border-gray-100 px-4 py-3 hover:bg-gray-50">Nosotros</Link>
                        </li>
                        <li>
                            <Link :href="'/programas'" class="block border-b border-gray-100 px-4 py-3 hover:bg-gray-50">Programas</Link>
                        </li>
                        <li>
                            <Link :href="'/posgrado'" class="block border-b border-gray-100 px-4 py-3 hover:bg-gray-50">Posgrado</Link>
                        </li>
                        <li>
                            <Link :href="`/escuela/${currentSlug}/documentos`" class="block border-b border-gray-100 px-4 py-3 hover:bg-gray-50">Documentos</Link>
                        </li>
                        <li>
                            <Link :href="`/escuela/${currentSlug}/publicaciones`" class="block border-b border-gray-100 px-4 py-3 hover:bg-gray-50">Publicaciones</Link>
                        </li>
                    </ul>
                </nav>
                <div class="border-t border-gray-200 px-4 py-4 text-xs text-gray-600 space-y-2">
                    <div class="flex items-center gap-2">
                        <svg
                            class="h-4 w-4 text-gray-500"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21.75 8.25v8.25a2.25 2.25 0 01-2.25 2.25h-15A2.25 2.25 0 012.25 16.5V8.25m19.5 0A2.25 2.25 0 0019.5 6h-15A2.25 2.25 0 002.25 8.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.5a2.25 2.25 0 01-2.31 0l-7.5-4.5A2.25 2.25 0 012.25 8.493V8.25"
                            />
                        </svg>
                        <span>contacto@unap.edu.pe</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg
                            class="h-4 w-4 text-gray-500"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 4.5l4.72-1.26a1.5 1.5 0 011.58.54l2.1 2.8a1.5 1.5 0 01-.17 1.98L8.21 10.8a11.048 11.048 0 005 5l2.24-2.27a1.5 1.5 0 011.98-.17l2.8 2.1a1.5 1.5 0 01.54 1.58L19.5 21.75A1.5 1.5 0 0118.03 23C10.832 22.61 5.39 17.168 5 9.97A1.5 1.5 0 016.25 8.5l1.73-.46"
                            />
                        </svg>
                        <span>+595 21 585 588</span>
                    </div>
                </div>
            </div>
        </div>
        <main class="flex-1">
            <slot/>
        </main>
        <footer class="bg-hero text-gray-700 pt-4 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center space-y-2">
                    <h4 class="text-sm font-semibold">ESCUELA PROFESIONAL DE ARQUITECTURA Y URBANISMO</h4>
                    <div class="text-sm text-gray-700">Ciudad universitaria, Puno</div>
                    <div class="text-sm text-gray-700">contacto@unap.edu.pe</div>
                    <div class="text-sm text-gray-700">Tel: +595 21 585 588</div>
                </div>

                <!-- Quick links -->
                <div class="text-center">
                    <h4 class="text-sm font-semibold mb-3">Enlaces Rápidos</h4>
                    <nav class="flex flex-col md:flex-row justify-center gap-2 text-sm">
                        <Link :href="'/'" class="hover:text-gray-500">Inicio</Link>
                        <Link :href="'/nosotros#funciones'" class="hover:text-gray-500">Nosotros</Link>
                        <Link :href="'/nosotros#documentos'" class="hover:text-gray-500">Escuelas</Link>
                        <Link :href="'/nosotros#miembros'" class="hover:text-gray-500">Documentos</Link>
                    </nav>
                </div>

                <!-- Socials -->
                <div class="text-center">
                    <h4 class="text-sm font-semibold mb-3">Síguenos</h4>
                    <div class="flex items-center justify-center gap-3">
                        <a href="#" class="w-9 h-9 rounded-full border border-slate-700 flex items-center justify-center text-slate-700 hover:bg-slate-700">
                            <!-- Facebook -->
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 5 3.66 9.13 8.44 9.95v-7.05H8.1v-2.9h2.34V9.41c0-2.32 1.37-3.6 3.47-3.6.99 0 2.03.18 2.03.18v2.23h-1.14c-1.13 0-1.48.7-1.48 1.42v1.7h2.51l-.4 2.9h-2.11v7.05C18.34 21.2 22 17.07 22 12.07z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full border border-slate-700 flex items-center justify-center text-slate-700 hover:bg-slate-700">
                            <!-- X/Twitter -->
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19.633 7.997c.013.176.013.353.013.53 0 5.4-4.11 11.62-11.62 11.62A11.56 11.56 0 016 18.62c.3.037.613.05.927.05a8.208 8.208 0 005.08-1.75 4.098 4.098 0 01-3.83-2.85c.25.037.5.05.775.05.38 0 .76-.05 1.12-.137a4.095 4.095 0 01-3.28-4.02v-.05c.55.3 1.22.5 1.92.52a4.095 4.095 0 01-1.82-3.4c0-.75.2-1.4.54-1.98A11.62 11.62 0 003.08 6.61a4.07 4.07 0 001.27 5.46 4.04 4.04 0 01-1.85-.512v.05c0 1.9 1.35 3.49 3.15 3.86a4.12 4.12 0 01-1.84.07c.52 1.63 2.04 2.83 3.83 2.86A8.225 8.225 0 012 20.1a11.615 11.615 0 006.29 1.84c7.55 0 11.68-6.26 11.68-11.68 0-.178-.013-.36-.025-.53A8.38 8.38 0 0022 7.06a8.18 8.18 0 01-2.367.65A4.13 4.13 0 0020 6.2a8.235 8.235 0 01-2.367.67z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full border border-slate-700 flex items-center justify-center text-slate-700 hover:bg-slate-700">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 6.5A4.5 4.5 0 1016.5 13 4.5 4.5 0 0012 8.5zM18.5 6.25a1.25 1.25 0 11-1.25-1.25 1.25 1.25 0 011.25 1.25z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full border border-slate-700 flex items-center justify-center text-slate-700 hover:bg-slate-700">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM0 8h5V24H0zM9 8h4.8v2.2h.07c.67-1.27 2.3-2.6 4.73-2.6C23.24 7.6 24 10 24 14.27V24h-5V15.5c0-2.05-.04-4.68-2.86-4.68-2.86 0-3.3 2.24-3.3 4.54V24H9z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
                <div class="border-t border-gray-100">
                    <div class="max-w-7xl mx-auto px-6 py-4 text-center text-xs text-gray-500">© {{ currentYear }} OTI - UNAP &nbsp;&nbsp;|&nbsp;&nbsp; Desarrollado en <a class="underline" href="#">Subunidad de Gobierno Electrónico</a></div>
                </div>
                <button @click="scrollToTop" class="fixed right-4 bottom-6 z-50 w-10 h-10 bg-primary text-white rounded shadow flex items-center justify-center hover:scale-105 transition-transform" aria-label="Subir al inicio">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
            </button>
        </footer>
    </div>
</template>
<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  slug: {
    type: String,
    default: ''
  },
  school: {
    type: Object,
    default: () => ({})
  }
});

const page = usePage();

const app = computed(() => page.props.value?.app ?? {});
const currentSchool = computed(() => props.school || (page.props.value?.school ?? null));
const currentSlug = computed(() => props.slug || currentSchool.value?.slug || 'epau');
const logoUrl = computed(() => currentSchool.value?.image_url || app.value.default_logo || '/img/logo_epau.jpeg');
const escuelasData = computed(() => props.school.programs ?? []);

const mobileOpen = ref(false);
const mobileEscuelasOpen = ref(false);
const escuelasOpen = ref(false);

// Clase Tailwind para controlar el max-width del dropdown (se usa junto con w-max)
const escuelasMaxClass = 'max-w-sm';

function toggleMobileEscuelas(){
    mobileEscuelasOpen.value = !mobileEscuelasOpen.value;
}
const toggleMobile=()=>{
    mobileOpen.value=!mobileOpen.value;
}
const currentYear = new Date().getFullYear();

function scrollToTop(){
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
// Define the closeEscuelas function to close the dropdown
const closeEscuelas = () => {
  escuelasOpen.value = false;
};
</script>