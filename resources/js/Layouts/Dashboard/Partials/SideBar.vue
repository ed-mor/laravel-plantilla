<template>
    <div>
        <!-- Cuerpo del Sidebar -->
        <div class="flex flex-col justify-between w-56 bg-gray-800 h-screen">                
            <body>
                <menu-sidebar></menu-sidebar>
            </body>

            <footer>
                <footer-sidebar></footer-sidebar>
            </footer>             
        </div>
    </div>
</template>

<script>
    import FooterSidebar from '@/Layouts/Dashboard/Partials/FooterSidebar'
    import MenuSidebar from '@/Layouts/Dashboard/Partials/MenuSidebar'

	export default {
        components: {
            FooterSidebar,
            MenuSidebar,
        },
        props: {
            showingSidebar: {
              type: Boolean,
            }
        },
	}
</script>