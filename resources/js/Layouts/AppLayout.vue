<template>
	
  <div class="bg-blue-50">
    <!-- <portal-target name="dropdown" slim /> -->
    <jet-banner />
    <div class="md:flex md:flex-col">
      <div class="md:h-screen md:flex md:flex-col">
        <div class="md:flex md:flex-shrink-0">
          <!-- Encabezado SideBar -->
          <div v-show="showingSidebar" class="bg-blue-900 md:flex-shrink-0 md:w-56 md:h-16 px-6 py-4 flex items-center justify-between md:justify-center">
            <head-sidebar 
              v-bind:showingSidebar.sync="showingSidebar">
            </head-sidebar>
          </div>
          <!-- Barra de Navegación -->
          <div class="w-full items-center md:py-0 text-sm md:text-md">
            <nav-bar 
              v-bind:ref="'myNavBar'"
              v-bind:showingSidebar.sync="showingSidebar">
            </nav-bar>
          </div>
        </div>
        <!-- Sidebar y Contenido -->
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <side-bar 
            v-show="showingSidebar" 
            class ="hidden md:block" 
            v-bind:showingSidebar.sync="showingSidebar">
          </side-bar>
          <div class="md:flex-1 px-2 py-2 md:p-2 md:overflow-y-auto" scroll-region>
            <!-- <flash-messages /> -->
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>
<script>
  import JetApplicationMark from '@/Jetstream/ApplicationMark'
  import JetBanner from '@/Jetstream/Banner'
  //import FlashMessages from '@/Shared/FlashMessages'
  import SideBar from '@/Layouts/Dashboard/Partials/SideBar'    
  import NavBar from '@/Layouts/Dashboard/Partials/NavBar'    
  import HeadSidebar from '@/Layouts/Dashboard/Partials/HeadSidebar'    
  import Swal from 'sweetalert2'

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  export default {
    data () {
        return {
            showingSidebar: true,
        } 
    },
    watch: {
      '$page.props.flash': {
        handler() {
            //debugger
            if (this.$page.props.flash){
              //console.log(this.$page.props.flash.success);
              if (this.$page.props.flash.success){
                Toast.fire({
                  icon: 'success',
                  title: this.$page.props.flash.success
                })                           
              }
              if (this.$page.props.flash.error){
                Toast.fire({
                  icon: 'error',
                  title: this.$page.props.flash.error
                })                                         
              }
            }
        },
      },
    },
    methods: {
      hideSidebar() {
        this.showingSidebar = !showingSidebar
      },
    },
    components: {
        JetApplicationMark,
		    JetBanner,
        //FlashMessages,
	      NavBar,
        SideBar,
        HeadSidebar,
    }
  }
</script>
