<template>
  <div class="max-w-3xl mt-1 rounded-xl shadow-xl bg-white p-6">
    <div class="mb-3 flex justify-between max-w-3xl">
      <h1 class="font-bold text-2xl">
          <inertia-link class="text-blue-900 hover:text-indigo-600" :href="route('users')">
            Usuarios
          </inertia-link>
          <span class="text-indigo-400 font-medium">/</span>
          {{ form.name }}          
      </h1>
      <div>
        <span v-if="user_a.account_name" class="font-bold text-2xl"> <b>Cta:</b> {{user_a.account_name}}</span>
      </div>
    </div>
    <trashed-message v-if="user_a.deleted_at" class="mb-6" @restore="restore" @forceDelete="forceDelete">
      Este Usuario fue elimanado en fecha: {{user_a.deleted_at}}
    </trashed-message>
    <div class="bg-white rounded shadow border-2 overflow-hidden max-w-3xl">
      <form @submit.prevent="submit">
        <div class="p-6 mr-3 -mb-2 flex flex-wrap justify-around">

          <div class="items-start">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden"
                        ref="photo"
                        @change="updatePhotoPreview">
            <jet-label for="photo" value="Fotografia:" />
            <!-- Current Profile Photo -->
            <div class="mt-2" v-show="! photoPreview">
                <img :src="user_a.profile_photo_path" :alt="user_a.name" class="rounded-lg h-44 w-44 object-cover">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" v-show="photoPreview">
                <span class="block rounded-lg w-44 h-44"
                      :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>

            <div v-if="!user_a.deleted_at">
              <jet-secondary-button class="mt-6 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                  Nueva foto
              </jet-secondary-button>
              <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="user_a.profile_photo_path">
                  Remover foto
              </jet-secondary-button>            
            </div>
          </div>

          <div class="ml-2 mt-8">
            <select-input v-if="!user_a.deleted_at" v-model="form.account_id" :error="errors.account_id" label="Cuenta" class="pr-1 pb-1 mb-2 w-full text-right">
              <option :value="null" />
              <option v-for="account in accounts" :key="account.id" :value="account.id">
                {{account.name}}
              </option>
            </select-input>
            <text-input v-model="form.name" :error="errors.name" class="pr-1 pb-1 w-full text-right" label="Nombre" />
            <text-input v-model="form.email" :error="errors.email" class="pr-1 pb-1 mt-2 w-full text-right" label="Email" />
            <text-input v-model="form.password" :error="errors.password" class="pr-1 pb-1 mt-2 w-full text-right" type="password" autocomplete="new-password" label="Password" />

            <div v-if="!user_a.deleted_at" class="pr-6 ml-5 mt-8 w-full text-right">
              <label class="py-1 mx-4 text-right">Status:</label>             
              <label v-if="form.status" class="bg-green-600 rounded-xl px-3 py-1 mx-4 font-extrabold text-white">Activo</label>
              <label v-else class="bg-gray-600 rounded-xl px-3 py-1 mx-4 font-extrabold text-white">Inactivo</label>
              <t-toggle checked v-model="form.status" class="h-7"/>
            </div>

          </div>
        </div>
        <div v-if="!user_a.deleted_at" class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
          <button class="px-3 py-3 rounded bg-red-900 text-white text-md h-12 uppercase font-bold whitespace-no-wrap hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar Usuario</button>
          <loading-button :loading="sending" class="px-3 py-3 rounded bg-blue-900 text-white text-md h-12 uppercase font-bold whitespace-no-wrap ml-auto hover:underline" type="submit">Actualizar Usuario</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import VueTailwind from 'vue-tailwind'
  import TToggle from 'vue-tailwind/dist/t-toggle'
  import AppLayout from '@/Layouts/AppLayout'
  import LoadingButton from '@/Shared/LoadingButton'
  import SelectInput from '@/Shared/SelectInput'
  import TextInput from '@/Shared/TextInput'
  import FileInput from '@/Shared/FileInput'
  import TrashedMessage from '@/Shared/TrashedMessage'
  import JetSecondaryButton from '@/Jetstream/SecondaryButton'
  import JetLabel from '@/Jetstream/Label'
  import Swal from 'sweetalert2'

export default {
  layout: AppLayout,
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  components: {
    LoadingButton,
    SelectInput,
    TextInput,
    TToggle,
    FileInput,
    TrashedMessage,
    JetSecondaryButton,
    JetLabel,
  },
  props: {
    errors: Object,
    user_a: Object,
    accounts: Array,
  },
  remember: 'form',
  data() {
    return {
      sending: false,
      form: {
        name: this.user_a.name,
        email: this.user_a.email,
        password: this.user_a.password,
        status: this.user_a.status,
        account_id: this.user_a.account_id,
        profile_photo_path: null,
      },
      photoPreview: null,
    }
  },
  methods: {
    submit() {
      var data = new FormData()
      data.append('name', this.form.name || '')
      data.append('account_id', this.form.account_id || '')
      data.append('email', this.form.email || '')
      data.append('password', this.form.password || '')
      data.append('status', this.form.status ? '1' : '0')
      if (this.$refs.photo) {
          this.form.profile_photo_path = this.$refs.photo.files[0]
      }
      data.append('profile_photo_path', this.form.profile_photo_path || '')
      data.append('_method', 'put')

      this.$inertia.post(this.route('users.update', this.user_a.id), data, {
        onStart: () => this.sending = true,
        onFinish: () => this.sending = false,
        onSuccess: () => {
            this.form.profile_photo_path = null
            this.form.password = null
        },
      })     
    },
    deletePhoto() {
        this.$inertia.delete(route('users.deletePhoto', this.user_a.id), {
            preserveScroll: true,
            onSuccess: () => (this.photoPreview = null),
        });
    },
    updateProfileInformation() {
        if (this.$refs.photo) {
            this.form.profile_photo_path = this.$refs.photo.files[0]
        }

        this.form.post(route('user-profile-information.update'), {
            errorBag: 'updateProfileInformation',
            preserveScroll: true
        });
    },    
    selectNewPhoto() {
        this.$refs.photo.click();
    },
    updatePhotoPreview() {
        const reader = new FileReader();

        reader.onload = (e) => {
            this.photoPreview = e.target.result;
        };
        reader.readAsDataURL(this.$refs.photo.files[0]);
    },
    destroy() {
      
      Swal.fire({
        title: '¿ Seguro que desea eliminar el Usuario ?',
        text: "¡ Esto puede ser revertido posteriormente... !",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar Usuario!'
      }).then((result) => {
        if (result.isConfirmed) {
            this.$inertia.delete(this.route('users.destroy', this.user_a.id))
        }
      })      
    },
    forceDelete(){
      Swal.fire({
        title: '¿ Desea eliminar definitivamente el Usuario ?',
        text: "¡ Esto NO PODRÁ REVERTIRSE... !",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
            this.$inertia.delete(this.route('users.forcedelete', this.user_a.id))
        }
      })            
    },   
    restore() {

      Swal.fire({
        title: '¿ Desea restaurar el Usuario ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, restaurarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
            this.$inertia.put(this.route('users.restore', this.user_a.id))      
        }
      })      
    },
  },
}
</script>
