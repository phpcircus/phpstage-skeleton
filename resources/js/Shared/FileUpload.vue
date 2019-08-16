<template>
    <label class="file-select">
        <div class="btn btn-green cursor-pointer" :class="additionalClasses">
            <span v-if="value">Selected File: {{ value.name }}</span>
            <span v-else>{{ prompt }}</span>
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
