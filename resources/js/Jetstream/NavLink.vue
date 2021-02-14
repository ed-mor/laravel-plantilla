<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-blue-600 text-sm font-medium leading-5 text-gray-900 rounded-sm focus:outline-none hover:bg-gray-200 focus:border-blue-900 shadow-lg bg-gray-100 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 text-gray-900 rounded-smborder-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
            }
        }
    }
</script>
