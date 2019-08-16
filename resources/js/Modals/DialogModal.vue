<template>
    <div class="flex flex-col">
        <div class="flex flex-col bg-blue-900 w-full text-center py-4">
            <h1 class="text-white text-3xl uppercase mb-4">{{ title }}</h1>
            <p class="text-white text-sm">{{ text }}</p>
        </div>
        <div class="bg-white mx-8 my-4">
            <div class="w-full max-w-sm mb-12">
                <div class="flex justify-between px-4">
                    <button v-for="button in buttons" :key="button.title" type="button" class="btn btn-text" :class="buttonTextColor(button)" @click="button.handler">
                        {{ button.title }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        text: String,
        buttons: Array,
    },
    data () {
        return {
            sending: false,
        }
    },
    methods: {
        buttonTextColor (button) {
            if (button.type === 'delete') {
                return 'text-red-500';
            }
            if (button.type === 'create' || button.type === 'restore') {
                return 'text-green-500'
            }
            if (button.type === 'info') {
                return 'text-blue-500'
            }
            if (button.type === 'close') {
                return 'text-gray-500'
            }
        },
    },
}
</script>
