<template>
    <div :class="display">
        <div :class="margin">
            <inertia-link class="flex items-center group py-3" :href="route('home')">
                <icon name="home" class="w-4 h-4 mr-2" :class="isPath('home') ? 'fill-white' : 'fill-blue-300 group-hover:fill-white'" />
                <div :class="isPath('home') ? 'text-white' : 'text-blue-200 group-hover:text-white'" class="text-xl">Home</div>
            </inertia-link>
        </div>
        <div>
            <inertia-link class="flex items-center group py-3" :href="route('about')">
                <icon name="user" class="w-4 h-4 mr-2" :class="isPath('about') ? 'fill-white' : 'fill-blue-300 group-hover:fill-white'" />
                <div :class="isPath('about') ? 'text-white' : 'text-blue-200 group-hover:text-white'" class="text-xl">About Me</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Icon from '@/Shared/Icon';

export default {
    components: {
        Icon,
    },
    props: {
        display: {
            type: String,
            default: 'block',
        },
    },
    computed: {
        margin () {
            if (this.display === 'block' || this.display === 'flex flex-col') {
                return 'mb-4';
            } else if (this.display === 'flex flex-row') {
                return 'mr-8';
            } else {
                return 'mb-4';
            }
        },
    },
}
</script>
