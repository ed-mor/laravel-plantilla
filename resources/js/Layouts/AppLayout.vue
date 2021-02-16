<template>
    <div class="flex bg-red-900">
        <jet-banner />
        <side-bar v-show="showingSidebar"></side-bar>
        <nav-link v-bind:showingSidebar.sync="showingSidebar"></nav-link>
    </div>
</template>

<script>
    import JetBanner from '@/Jetstream/Banner'
    import SideBar from '@/Layouts/Dashboard/Partials/SideBar'    
    import NavLink from '@/Layouts/Dashboard/Partials/NavLink'    

    export default {
        data () {
            return {
                showingSidebar: true,    
            } 
        },
        components: {
            JetBanner,
            SideBar,
            NavLink,
        }
    }
</script>
