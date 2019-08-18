<template>
    <layout title="Create User">
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-light hover:text-blue-700" :href="route('users.list')">Users</inertia-link>
            <span class="text-blue-300 font-medium">/</span> Create
        </h1>
        <div class="bg-white rounded shadow overflow-hidden max-w-lg">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-col">
                    <div class="flex flex-wrap">
                        <text-input v-model="form.name" :errors="getErrors('name')" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
                        <text-input v-model="form.email" :errors="getErrors('email')" class="pb-8 w-full lg:w-1/2" label="Email" />
                    </div>
                    <div class="flex flex-wrap">
                        <checkbox v-model="form.is_admin" :errors="getErrors('is_admin')" class="pb-8 text-lg w-full lg:w-1/2" label="Administrator? " :width="4" :height="4" :checked="form.is_admin" />
                        <text-input v-model="form.password" :errors="getErrors('password')" class="pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
                    </div>
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
                    <loading-button :loading="sending" class="btn btn-blue" type="submit">Create User</loading-button>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Shared/Layout';
import Checkbox from '@/Shared/Checkbox';
import TextInput from '@/Shared/TextInput';
import LoadingButton from '@/Shared/LoadingButton';

export default {
    components: {
        Layout,
        LoadingButton,
        Checkbox,
        TextInput,
    },
    remember: 'form',
    data () {
        return {
            sending: false,
            form: {
                name: null,
                email: null,
                is_admin: false,
                password: null,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.post(this.route('users.store'), this.form)
            .then(() => this.sending = false)
        },
    },
}
</script>
