<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo>
                <span class="text-3xl text-gray-600 font-extrabold text-center p-4">Restablecer contraseña</span>
            </jet-authentication-card-logo>
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" class="font-bold text-xl" value="Correo electrónico" />
                <jet-input id="email" type="email" class="mt-1 block w-full text-lg" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" class ="font-bold text-xl" value="Contraseña" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" class="font-bold text-xl" value="Confirmar Contraseña" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Restablecer la contraseña
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
