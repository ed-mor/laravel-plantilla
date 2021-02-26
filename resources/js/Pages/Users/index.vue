<template>
    <app-layout ref="myAppLayout" v-bind:showingSidebar.sync="showingSidebar"> 
        <template>
          <div class="m-auto w-full rounded-xl shadow-xl bg-white p-6">
            <h1 class="mb-5 font-bold text-2xl">Usuarios</h1>
            <div class="mb-4 flex justify-between items-center">
            <search-filter v-model="form.buscar" class="w-full max-w-md mr-4" @reset="reset">

                <label class="block text-gray-700">Status:</label>
                <select v-model="form.status" class="mt-1 w-full form-select">
                  <option :value="null">nulo</option>
                  <option value=1>Activos</option>
                  <option value=null>Inactivos</option>
                </select>
                <label class="mt-4 block text-gray-700">Eliminados:</label>
                <select v-model="form.eliminados" class="mt-1 w-full form-select">
                  <option :value="null">nulo</option>
                  <option value="with">Con Eliminados</option>
                  <option value="only">Solo Eliminados</option>
                </select>

            </search-filter>
              <inertia-link class="px-3 py-3 rounded bg-blue-900 text-white text-md h-12 uppercase font-bold whitespace-no-wrap" :href="route('users.create')">
                <span>Crear</span>
                <span class="hidden md:inline">usuario</span>
              </inertia-link>
            </div>
            <div class="bg-white rounded shadow overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <tr class="text-left text-xl font-bold bg-gray-300">
                  <th class="px-6 pt-4 pb-3">Nombre</th>
                  <th class="px-6 pt-4 pb-3">Correo</th>
                  <th class="px-6 pt-4 pb-3">Status</th>
                  <th class="px-6 pt-4 pb-3" colspan="2">&nbsp;</th> 
                </tr>
                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                  <td class="border-t">
                    <inertia-link class="px-3 py-2 flex items-center focus:text-indigo-500" :href="route('users.edit', user.id)">
                      <img v-if="user.photo" class="block w-5 h-5 rounded-full mr-2 -my-2" :src="user.photo">
                      {{ user.name }}
                      <icon v-if="user.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2" />
                    </inertia-link>
                  </td>
                  <td class="border-t">
                    <inertia-link class="px-3 py-2 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                      {{ user.email }}
                    </inertia-link>
                  </td>
                  <td class="border-t">
                    <inertia-link class="px-6 py-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                      {{ user.status ? 'Activo' : 'Inactivo' }}
                    </inertia-link>
                  </td>
                  <td class="border-t w-px">
                    <inertia-link class="px-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                      <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
                    </inertia-link>
                  </td>
                </tr>
                <tr v-if="users.length === 0">
                  <td class="border-t px-6 py-4" colspan="4">Usuarios no encontrados</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="h-32">
          </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Icon from '@/Shared/Icon'
//import Layout from '@/Shared/Layout'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import SearchFilter from '@/Shared/SearchFilter'
import throttle from 'lodash/throttle'

export default {
  metaInfo: { title: 'Users' },
  //layout: Layout,
  components: {
    AppLayout,
    Icon,
    SearchFilter,
  },
  props: {
    users: Array,
    filters: Object,
    showingSidebar: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      form: {
        buscar: this.filters.buscar,
        status: this.filters.status,
        eliminados: this.filters.eliminados,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        console.log(query);        
        //debugger
        this.$inertia.replace(this.route('users', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>

