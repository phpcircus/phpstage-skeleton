<template>
    <div>
        <portal-target name="dropdown" slim />
        <flash-message />
        <div class="flex flex-col">
            <div class="flex flex-col" @click="hideDropdownMenus">
                <div class="flex flex-wrap">
                    <div class="bg-blue-900 flex-no-shrink w-full px-4 py-8 md:p-12 flex justify-between items-center">
                        <inertia-link class="mt-1" :href="route('home')">
                            <logo position="left" />
                        </inertia-link>
                        <div class="hidden md:block">
                            <main-menu display="flex flex-row" />
                        </div>
                        <dropdown class="block md:hidden" placement="bottom-end">
                            <svg class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                            <div slot="dropdown" class="mt-2 px-8 py-4 shadow-lg bg-blue-800 rounded">
                                <main-menu />
                            </div>
                        </dropdown>
                    </div>
                    <div class="flex w-full h-20 bg-white bg-tictac border-b shadow p-4 px-4 py-8 md:px-12 text-sm md:text-base justify-between items-center relative">
                        <div class="mt-1 mr-4">&nbsp;</div>
                        <dropdown v-if="$page.auth.user" class="mt-1 md:ml-auto " placement="bottom-end">
                            <div class="flex items-center cursor-pointer select-none group">
                                <div class="text-blue-900 group-hover:text-blue-700 focus:text-blue-700 mr-1 whitespace-no-wrap">
                                    <span class="inline">{{ $page.auth.user.name }}</span>
                                </div>
                                <icon class="w-5 h-5 group-hover:fill-blue-700 fill-blue-900 focus:fill-blue-700" name="cheveron-down" />
                            </div>
                            <div slot="dropdown" class="mt-2 py-2 shadow-lg bg-white rounded text-sm">
                                <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('users.edit', $page.auth.user.id)">My Profile</inertia-link>
                                <div v-if="$page.auth.user.is_admin">
                                    <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('users')">Manage Users</inertia-link>
                                </div>
                                <inertia-link class="block px-6 py-2 hover:bg-blue-500 hover:text-white" :href="route('logout')" method="post">Logout</inertia-link>
                            </div>
                        </dropdown>
                    </div>
                </div>
                <div class="flex flex-grow w-full relative">
                    <social-links />
                    <div class="overflow-hidden px-4 py-8 md:p-12 w-full">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
        <site-footer />
    </div>
</template>

<script>
    import Icon from '@/Shared/Icon';
    import Logo from '@/Shared/Logo';
    import Dropdown from '@/Shared/Dropdown';
    import MainMenu from '@/Shared/MainMenu';
    import SiteFooter from '@/Shared/SiteFooter';
    import SocialLinks from '@/Shared/SocialLinks';
    import FlashMessage from '@/Shared/FlashMessage';

    export default {
        components: {
            Dropdown,
            Icon,
            Logo,
            MainMenu,
            SocialLinks,
            FlashMessage,
            SiteFooter,
        },
        props: {
            title: String,
        },
        data () {
            return {
                showUserMenu: false,
                accounts: null,
            }
        },
        head: {
            title: function () {
                return {
                    inner: this.title,
                }
            },
        },
        methods: {
            hideDropdownMenus () {
                this.showUserMenu = false;
            },
        },
    }
</script>
