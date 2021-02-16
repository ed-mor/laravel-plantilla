<template>
    <div class="w-56 h-full hidden md:inline-flex">
        <div class="flex justify-center bg-gray-900 w-56 h-16">
             <!-- Logo -->
            <inertia-link :href="route('home')">
                <template>                    
                    <div class="flex-shrink-0 flex items-center">
                        <jet-application-mark class="block h-9 w-auto" />
                        <div class="text-white p-4">
                            Home
                        </div>
                    </div>
                </template>
            </inertia-link>
        </div>
    </div>

</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'

	export default {
        components: {
            JetApplicationMark,
        },

        // props: {
        //     showingSidebar: {
        //       type: Boolean,
        //       requiered: true,
        //     }
        // },
	}
</script>