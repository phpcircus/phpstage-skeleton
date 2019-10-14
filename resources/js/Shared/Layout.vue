<template>
    <div>
        <modal />
        <flash-message />

        <!-- TOP BARS -->
        <div class="fixed top-0 w-full" style="z-index:80">
            <!-- TOP BLUE BAR -->
            <div class="flex justify-between items-center w-full px-4 py-8 bg-blue-800 ">
                <inertia-link class="mt-1" :href="route('dashboard')">
                    <logo position="left" />
                </inertia-link>
                <div class="hidden md:block">
                    <main-menu display="flex flex-row" />
                </div>
            </div>

            <!-- TOP WHITE BAR -->
            <div class="flex justify-between items-center w-full text-sm md:text-base bg-white border-b shadow h-16 p-4 py-8">
                <div class="mt-1 mr-4">&nbsp;</div>
                <dropdown v-if="$page.auth.user" class="mt-1 md:ml-auto " width="180" :nav="true">
                    <div slot="trigger" class="flex items-center cursor-pointer select-none group">
                        <div class="flex text-blue-800 group-hover:text-blue-500 focus:text-blue-500 mr-1 whitespace-no-wrap">
                            <icon-base icon-function="user" :width="14" :height="14" icon-fill="fill-blue-800" classes="mr-2 group-hover:fill-blue-500">
                                <user />
                            </icon-base>
                            <span class="inline">{{ $page.auth.user.name }}</span>
                            <icon-base icon-function="cheveron-down" icon-fill="fill-blue-800" classes="ml-2 group-hover:fill-blue-500">
                                <cheveron-down />
                            </icon-base>
                        </div>
                    </div>
                    <div slot="dropdown" class="mt-2 shadow-lg bg-white rounded text-sm">
                        <user-menu />
                    </div>
                </dropdown>
                <div v-else class="flex text-blue-800 group-hover:text-blue-500 focus:text-blue-500 mr-1 whitespace-no-wrap">
                    <inertia-link class="flex group" :href="route('login.form')">
                        <icon-base icon-function="login" :width="14" :height="14" icon-fill="fill-blue-800" classes="mr-2 group-hover:fill-blue-500">
                            <lock-closed />
                        </icon-base>
                        <span class="inline-block text-blue-800 group-hover:text-blue-500">Login</span>
                    </inertia-link>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-grow w-full relative mt-140p">
            <div class="overflow-hidden px-4 py-8 lg:py-12 w-full">
                <breadcrumbs />
                <slot />
            </div>
        </div>

        <!-- Site Footer -->
        <site-footer />
    </div>
</template>

<script>
import Logo from '@/Shared/Logo';
import Modal from '@/Shared/Modal';
import User from '@/Shared/Icons/User';
import IconBase from '@/Shared/IconBase';
import MainMenu from '@/Shared/MainMenu';
import UserMenu from '@/Shared/UserMenu';
import Dropdown from '@/Shared/Dropdown';
import SiteFooter from '@/Shared/SiteFooter';
import Breadcrumbs from '@/Shared/Breadcrumbs';
import FlashMessage from '@/Shared/FlashMessage';
import LockClosed from '@/Shared/Icons/LockClosed';
import CheveronDown from '@/Shared/Icons/CheveronDown';

export default {
    components: {
        Logo,
        User,
        Modal,
        IconBase,
        UserMenu,
        MainMenu,
        Dropdown,
        SiteFooter,
        LockClosed,
        Breadcrumbs,
        FlashMessage,
        CheveronDown,
    },
    props: {
        title: String,
    },
    head: {
        title: function () {
            return {
                inner: this.title,
            }
        },
    },
}
</script>
