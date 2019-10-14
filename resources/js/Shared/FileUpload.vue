<template>
    <label class="file-select">
        <div class="btn btn-green cursor-pointer leading-tight" :class="additionalClasses">
            <span v-if="value">Selected File: {{ value.name }}</span>
            <div v-else class="flex">
                <slot />
                <span>{{ prompt }}</span>
            </div>
        </div>
        <input class="hidden" type="file" @change="handleFileChange" />
    </label>
</template>

<script>
export default {
    props: {
        value: File,
        buttonClasses: String,
        prompt: {
            type: String,
            default: 'Select File',
        },
    },
    computed: {
        additionalClasses () {
            return this.buttonClasses;
        },
    },
    methods: {
        handleFileChange (e) {
            this.$emit('input', e.target.files[0])
        },
    },
}
</script>
