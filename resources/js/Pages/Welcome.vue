<template>
    <div class="relative flex justify-center min-h-screen bg-gray-200 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="font-bold mr-3 p-2 my-2 bg-gray-400 text-red-700 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                Panel de Control
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="font-bold mr-3 p-2 my-2 bg-gray-400 text-red-700 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                    Iniciar Sesión
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="font-bold p-2 my-2 bg-gray-400 text-red-700 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                    Registrarse
                </inertia-link>
            </template>

        </div>
        <div class="container sm:my-auto my-auto">
            <h1 class="py-20 md:py-16 mx-14 md:text-7xl lg:text-9xl sm:text-6xl text-6xl sm:text-center text-center font-bold bg-gray-400 items-center rounded-3xl shadow-lg h-60 text-red-700">Welcome</h1>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            //  theme: String,
        }
    }
</script>