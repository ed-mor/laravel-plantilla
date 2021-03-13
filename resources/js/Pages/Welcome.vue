<template>
    <div class="relative flex justify-center min-h-screen bg-green-900 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="font-bold mr-3 p-2 my-2 bg-gray-400 border-b-4 border-blue-600 text-blue-700 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                Panel de Control
            </inertia-link>

            <template v-else>
                <inertia-link :href="route('login')" class="font-bold mr-3 p-2 my-2 bg-gray-400 text-blue-700 border-b-4 border-blue-600 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                    Iniciar Sesión
                </inertia-link>

                <inertia-link v-if="canRegister" :href="route('register')" class="font-bold p-2 my-2 bg-gray-400 text-blue-700 border-b-4 border-blue-600 rounded-md hover:bg-gray-300 ring-gray-200 ring-offset-2 shadow-2xl">
                    Registrarse
                </inertia-link>
            </template>

        </div>
        <!-- <button class="bg-gray-100" @click="showAlert">Hello world</button> -->
        <div class="container sm:my-auto my-auto">
            <h1 class="py-20 md:py-16 mx-14 md:text-7xl lg:text-9xl sm:text-6xl text-6xl sm:text-center text-center font-bold bg-gray-400 items-center rounded-3xl shadow-2xl h-60 text-blue-700">Welcome</h1>
        </div>
    </div>
</template>


<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            //  theme: String,
        },
        // methods: {
        //     showAlert() {
        //         // Use sweetalert2
        //         this.$swal('Hello Vue world!!!');
        //     },
        // },
    }
</script>