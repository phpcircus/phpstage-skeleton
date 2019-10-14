<template>
    <div class="flex flex-col py-1">
        <inertia-link class="flex px-3 py-2 hover:bg-blue-500 hover:text-white group" :href="route('users.edit', $page.auth.user.id)">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="profile" classes="mr-2 group-hover:fill-white">
                <profile />
            </icon-base>
            My Profile
        </inertia-link>
        <div v-if="$page.auth.user.is_admin">
            <inertia-link class="flex px-3 py-2 hover:bg-blue-500 hover:text-white group" :href="route('users.list')">
                <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="users" classes="mr-2 group-hover:fill-white">
                    <users />
                </icon-base>
                Manage Users
            </inertia-link>
        </div>
        <inertia-link class="flex px-3 py-2 hover:bg-blue-500 hover:text-white group" :href="route('logout')" method="post">
            <icon-base width="14" height="14" icon-fill="fill-gray-800" icon-name="logout" classes="mr-2 group-hover:fill-white">
                <logout />
            </icon-base>
            Logout
        </inertia-link>
    </div>
</template>

<script>
import IconBase from '@/Shared/IconBase';
import Users from '@/Shared/Icons/Users';
import Logout from '@/Shared/Icons/Logout';
import Profile from '@/Shared/Icons/Profile';

export default {
    components: {
        Users,
        Logout,
        Profile,
        IconBase,
    },
}
</script>
