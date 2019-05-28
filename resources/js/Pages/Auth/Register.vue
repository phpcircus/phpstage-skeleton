<template>
    <blank-layout>
        <div class="px-6 bg-blue-800 min-h-screen flex justify-center pt-32">
            <div class="w-full max-w-sm">
                <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
                <form class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden" @submit.prevent="submit">
                    <div class="px-10 py-12">
                        <h1 class="text-center font-bold text-3xl">Register</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                        <text-input v-model="form.name" :errors="errors.name" class="mt-10" label="Name" type="name" autofocus />
                        <text-input v-model="form.email" :errors="errors.email" class="mt-10" label="Email" type="email" autocapitalize="off" />
                        <text-input v-model="form.password" :errors="errors.password" class="mt-6" label="Password" type="password" />
                        <text-input v-model="form.password_confirmation" class="mt-6" label="Confirm Password" type="password" />
                    </div>
                    <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
                        <inertia-link class="hover:underline" tabindex="-1" href="#">Already Registered?</inertia-link>
                        <loading-button :loading="sending" class="btn-blue" type="submit">Register</loading-button>
                    </div>
                </form>
            </div>
        </div>
    </blank-layout>
</template>

<script>
import Logo from '@/Shared/Logo';
import TextInput from '@/Shared/TextInput';
import BlankLayout from '@/Shared/BlankLayout';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        LoadingButton,
        Logo,
        TextInput,
        BlankLayout,
    },
    props: {
        errors: Object,
    },
    data () {
        return {
            sending: false,
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
        }
    },
    mounted () {
        document.title = `Register | ${this.$page.app.name}`;
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('register.attempt'), {
                name: this.form.name,
                email: this.form.email,
                password: this.form.password,
                password_confirmation: this.form.password_confirmation,
            }).then(() => {
                this.sending = false;
            });
        },
    },
}
</script>
