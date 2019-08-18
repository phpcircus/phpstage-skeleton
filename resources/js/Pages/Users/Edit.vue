<template>
    <layout :title="`Profile for ${form.name}`">
        <h1 class="mb-8 font-bold text-3xl">
            <inertia-link class="text-blue-300 hover:text-blue-700" :href="route('users.list')">Users</inertia-link>
            <span class="text-blue-300 font-medium">/</span>
            {{ form.name }}
        </h1>
        <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore">
            This user has been deleted.
        </trashed-message>
        <div class="bg-white rounded shadow overflow-hidden max-w-lg">
            <form @submit.prevent="submit">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <text-input v-model="form.name" :errors="getErrors('name')" class="pr-6 pb-8 w-full lg:w-1/2" label="Name" />
                    <text-input v-model="form.email" :errors="getErrors('email')" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
                    <checkbox v-if="$page.auth.user.is_admin" v-model="form.is_admin" :errors="getErrors('is_admin')" class="pb-8 text-lg w-full lg:w-1/2" label="Administrator? " :width="4" :height="4" :checked="form.is_admin" />
                    <text-input v-model="form.password" :errors="getErrors('password')" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />
                </div>
                <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center">
                    <button v-if="! user.deleted_at" class="text-red-500 hover:underline" tabindex="-1" type="button" @click="destroy">Delete User</button>
                    <loading-button :loading="sending" class="btn btn-blue ml-auto" type="submit">Update User</loading-button>
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
import TrashedMessage from '@/Shared/TrashedMessage';

export default {
    components: {
        Layout,
        Checkbox,
        LoadingButton,
        TextInput,
        TrashedMessage,
    },
    props: {
        user: Object,
    },
    remember: 'form',
    data () {
        return {
            sending: false,
            form: {
                id: this.user.id,
                name: this.user.name,
                email: this.user.email,
                is_admin: this.user.is_admin,
                password: this.user.password,
            },
        }
    },
    methods: {
        submit () {
            this.sending = true;
            this.$inertia.put(this.route('users.update', this.user.id), this.form).then(() => this.sending = false);
        },
        destroy () {
            this.$showDialog('warning', 'user', 'delete', () => {
                this.$inertia.delete(this.route('users.destroy', this.user.id), { replace: false, preserveScroll: true, preserveState: true });
                this.$modal.hide('dialogModal');
            });
        },
        restore () {
            this.$showDialog('warning', 'user', 'restore', () => {
                this.$inertia.put(this.route('users.restore', this.user.id), null, { replace: false, preserveScroll: true, preserveState: true });
                this.$modal.hide('dialogModal');
            });
        },
    },
}
</script>
