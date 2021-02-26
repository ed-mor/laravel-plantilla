<template>
    <div class="flex justify-center bg-blue-900 w-56 h-16">
        <!-- Logo -->
        <inertia-link :href="route('home')">
            <template>                    
                <div class="flex-shrink-0 flex items-center">
                    <jet-application-mark class="block h-9 w-auto" />
                    <div class="text-white text-xl p-4 uppercase font-bold hover:text-gray-400">
                        Inicio
                    </div>
                </div>
            </template>
        </inertia-link>
        <!-- Botón ocultar -->
        <div class="flex pt-2 pl-14 hidden md:inline-flex items-start">
            <button @click="$emit('update:showingSidebar', !showingSidebar)" class="inline-flex items-center justify-center px-0 py-2 rounded-md text-white hover:text-gray-100 hover:bg-gray-800 focus:outline-none focus:bg-gray-500 focus:text-gray-300 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': showingSidebar, 'inline-flex': ! showingSidebar }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! showingSidebar, 'inline-flex': showingSidebar }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>           
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    export default {
        components: {
            JetApplicationMark,
        },
        props: {
            showingSidebar: {
              type: Boolean,
            }
        },
    }
</script>