<template>
    <jet-action-section>
        <template #title>
            Eliminar Cuenta
        </template>

        <template #description>
            Elimina permanentemente su cuenta.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.
            </div>

            <div class="mt-5">
                <jet-danger-button @click.native="confirmUserDeletion">
                    Eliminar cuenta
                </jet-danger-button>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    Eliminar cuenta
                </template>

                <template #content>
                    ¿Estás seguro de que deseas eliminar tu cuenta? Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán permanentemente. Ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                    ref = "password"
                                    v-model="form.password"
                                    @keyup.enter.native="deleteUser" />

                        <jet-input-error :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="closeModal">
                        No eliminar cuenta
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deleteUser" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Eliminar Cuenta
                    </jet-danger-button>
                </template>
            </jet-dialog-modal>


        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionSection,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingUserDeletion: false,

                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            confirmUserDeletion() {             
                this.confirmingUserDeletion = true;
                setTimeout(() => this.$refs.password.focus(), 250)
            },
            deleteUser() {
                this.form.delete(route('current-user.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
            closeModal() {
                this.confirmingUserDeletion = false

                this.form.reset()
            },
        },
    }
</script>
