<template>
    <app-layout>
        <template>
            <div class="w-56 m-4 rounded-md shadow-xl bg-white">
                Dashboard            
            </div>
        </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        methods: {
            CambiaSidebar(showingSidebar){
                this.showingSidebar = showingSidebar;
                //debugger
                //showingSidebar
            }
        },
        props: {
            logo: String,
            // showingSidebar: {
            //   type: Boolean,
            //   default: true,
            // },
        }
    }
</script>
