<template>
    <layout title="Users">
        <h1 class="mb-8 font-bold text-3xl">Users</h1>
        <div class="mb-6 flex justify-between items-center">
            <search-filter v-model="form.search" class="w-full max-w-sm mr-4" @reset="reset">
                <label class="mt-4 block text-gray-900">Trashed:</label>
                <select v-model="form.trashed" class="mt-1 w-full form-select">
                    <option :value="null" />
                    <option value="with">With Trashed</option>
                    <option value="only">Only Trashed</option>
                </select>
            </search-filter>
            <inertia-link v-if="$page.auth.user.is_admin" class="btn btn-blue" :href="route('users.create')">
                <span>Create</span>
                <span class="hidden md:inline">User</span>
            </inertia-link>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Email</th>
                </tr>
                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center focus:text-blue-500" :class="user.deleted_at ? 'text-gray-700 focus:text-gray-500 hover:text-gray-500' : ''" :href="route('users.edit', user.id)">
                            {{ user.name }}
                            <icon-base v-if="user.deleted_at" icon-fill="fill-gray-500" classes="ml-2">
                                <trash />
                            </icon-base>
                        </inertia-link>
                    </td>
                    <td class="border-t">
                        <inertia-link class="px-6 py-4 flex items-center" :class="user.deleted_at ? 'text-gray-700 focus:text-gray-500 hover:text-gray-500' : ''" :href="route('users.edit', user.id)" tabindex="-1">
                            {{ user.email }}
                        </inertia-link>
                    </td>
                    <td class="border-t w-px">
                        <inertia-link class="px-4 flex items-center" :href="route('users.edit', user.id)" tabindex="-1">
                            <icon-base icon-fill="fill-gray-500" classes="ml-2">
                                <cheveron-right />
                            </icon-base>
                        </inertia-link>
                    </td>
                </tr>
                <tr v-if="users.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">No users found.</td>
                </tr>
            </table>
        </div>
    </layout>
</template>

<script>
import { mapValues, throttle, pickBy } from 'lodash';
import Layout from '@/Shared/Layout';
import IconBase from '@/Shared/IconBase';
import Trash from '@/Shared/Icons/Trash';
import SearchFilter from '@/Shared/SearchFilter';
import CheveronRight from '@/Shared/Icons/CheveronRight';

export default {
    components: {
        Trash,
        Layout,
        IconBase,
        SearchFilter,
        CheveronRight,
    },
    props: {
        users: Array,
        filters: Object,
    },
    data () {
        return {
            form: {
                search: this.filters.search,
                trashed: this.filters.trashed,
            },
        }
    },
    watch: {
        form: {
            handler: throttle(function () {
                let query = pickBy(this.form);
                this.$inertia.replace(this.route('users.list', Object.keys(query).length ? query : { remember: 'forget' }))
            }, 150),
            deep: true,
        },
    },
    methods: {
        reset () {
            this.form = mapValues(this.form, () => null);
        },
    },
}
</script>
