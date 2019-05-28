<template>
    <blank-layout>
        <div class="px-6 bg-blue-800 min-h-screen flex justify-center pt-32">
            <div class="w-full max-w-sm">
                <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
                <form class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden" @submit.prevent="submit">
                    <div class="px-10 py-12">
                        <h1 class="text-center font-bold text-2xl">Password Reset Request</h1>
                        <div class="mx-auto mt-6 w-24 border-b-2" />
                        <text-input v-model="form.email" class="mt-10" label="Email" :errors="errors.email" type="email" autofocus autocapitalize="off" />
                    </div>
                    <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
                        <loading-button :loading="sending" class="btn-blue" type="submit">Email Password Reset Instructions</loading-button>
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
        errors: {
            type: Object,
            default: () => ({}),
        },
    },
    data () {
        return {
            sending: false,
            form: {
                email: null,
            },
        }
    },
    mounted () {
        document.title = `Forgot Password | ${this.$page.app.name}`;
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('password.request.email'), {
                email: this.form.email,
            }).then(() => {
                this.sending = false;
            });
        },
    },
}
</script>
