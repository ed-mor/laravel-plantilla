<template>
    <app-layout ref="myAppLayout" v-bind:showingSidebar.sync="showingSidebar">
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
        data(){
            return{
                showingSidebar: true    
            }
        },
        beforeMount(){
            //console.log(this.$refs);
            
            //console.log(this.$parent.$vnode.data.props.initialPage.props.statusSidebar)
            //this.showingSidebar = this.$parent.$vnode.data.props.initialPage.props.statusSidebar
            //console.log(this.showingSidebar)
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
