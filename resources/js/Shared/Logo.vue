<template>
    <div class="w-full" :class="logoPosition">
        <h1 class="inline-block font-bold text-2xl sm:text-3xl md:text-5xl text-blue-500 site-title">PHP<span class="font-medium text-white">STAGE</span></h1>
    </div>
</template>

<script>
export default {
    props: {
        position: {
            type: String,
            default: 'center',
        },
    },
    computed: {
        logoPosition () {
            if (this.position === 'left') {
                return 'text-left';
            } else if (this.position === 'center') {
                return 'text-center mx-auto';
            } else {
                return 'text-right';
            }
        },
    },
}
</script>
