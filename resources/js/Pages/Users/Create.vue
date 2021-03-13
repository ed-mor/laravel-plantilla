<template>
  <div class="max-w-2xl rounded-xl shadow-xl bg-white p-6">
    <h1 class="mb-5 font-bold">
      <inertia-link class="text-blue-900 font-bold text-2xl hover:text-indigo-600" :href="route('users')">Usuarios</inertia-link>
      <span class="font-bold text-2xl">/ Crear Usuario</span> 
    </h1>
    <div class="bg-white rounded shadow border-2 overflow-hidden max-w-2xl">
      <jet-validation-errors class="m-4" />
      <form @submit.prevent="submit">
            <div class="mx-6 mt-2">
                <jet-label class="text-lg font-bold" for="name" value="Nombre" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mx-6 mt-2">
                <jet-label class="text-lg font-bold" for="email" value="Correo Electrónico" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mx-6 mt-2">
                <jet-label class="text-lg font-bold" for="password" value="Contraseña" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mx-6 mt-2 mb-4">
                <jet-label class="text-lg font-bold" for="password_confirmation" value="Confirmar contraseña" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="px-3 py-3 rounded bg-blue-900 text-white text-md h-12 uppercase font-bold whitespace-no-wrap hover:underline" type="submit">Crear Usuario</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
//  import Layout from '@/Shared/Layout'
import AppLayout from '@/Layouts/AppLayout'
import LoadingButton from '@/Shared/LoadingButton'
// import SelectInput from '@/Shared/SelectInput'
// import TextInput from '@/Shared/TextInput'
// import FileInput from '@/Shared/FileInput'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'


export default {
  metaInfo: { title: 'Crear Usuario' },
  layout: AppLayout,
  components: {
    //AppLayout,
    LoadingButton,
    // SelectInput,
    // TextInput,
    // FileInput,
    JetInput,
    JetLabel,
    JetValidationErrors

  },
  props: {
    errors: Object,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
        status: false,
        photo: null,
      },
    }
  },
  methods: {
    submit() {
      const data = new FormData()
      data.append('name', this.form.name || '')
      data.append('email', this.form.email || '')
      data.append('password', this.form.password || '')
      data.append('password_confirmation', this.form.password_confirmation || '')
      data.append('status', this.form.status ? '1' : '0')
      data.append('photo', this.form.photo || '')

      this.$inertia.post(this.route('users.store'), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
      })
    },
  },
}
</script>
