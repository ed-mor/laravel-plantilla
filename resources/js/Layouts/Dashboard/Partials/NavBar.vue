<template>
    <div class="bg-gray-100">
        <nav>
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl px-1 sm:px-2">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Botón Oculta Sidebar -->
                        <div class="flex pt-3 pr-3 hidden md:inline-flex items-start">
                            <button v-show="!showingSidebar" @click="$emit('update:showingSidebar', !showingSidebar)" class="inline-flex items-center justify-center px-0 py-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingSidebar, 'inline-flex': ! showingSidebar }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                        <!-- Navigation Links -->
                        <div class="hidden py-4 space-x-8 sm:-my-px sm:ml-0 sm:flex">
                            <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                Panel de Control
                            </jet-nav-link>
                        </div>

                        <div class="hidden py-4 space-x-8 sm:-my-px sm:ml-0 sm:flex">
                            <jet-nav-link :href="route('users')" :active="route().current('users')">
                                Usuarios
                            </jet-nav-link>
                        </div>                        
                    </div>
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <jet-dropdown align="right" width="48">
                                <template #trigger>
                                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                    </button>
                                </template>
                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Administración de la Cuenta
                                    </div>

                                    <jet-dropdown-link :href="route('profile.show')">
                                        Perfil del Usuario
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>
                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Cerrar sesión
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'

	export default {
        components: {
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
        },
        props: {
            showingSidebar: {
              type: Boolean,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
	}
</script>