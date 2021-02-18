<template>
    <div>
        <!-- Cuerpo del Sidebar -->
        <div class="flex flex-col justify-between w-56 bg-red-900 h-screen">                
            <div class="bg-red-900">
                body sidebar            
            </div>             
            <div class="bg-blue-900 pb-24">
                body sidebar            
            </div>             
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