<template>
    <div class="flex bg-red-900">
        <jet-banner />
        <side-bar></side-bar>
        <nav-link></nav-link>
    </div>
</template>

<script>
    import JetBanner from '@/Jetstream/Banner'
    import SideBar from '@/Layouts/Dashboard/Partials/SideBar'    
    import NavLink from '@/Layouts/Dashboard/Partials/NavLink'    

    export default {
        components: {
            JetBanner,
            SideBar,
            NavLink,
        }
    }
</script>
