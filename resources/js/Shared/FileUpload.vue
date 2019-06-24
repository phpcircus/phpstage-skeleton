<template>
    <label class="file-select">
        <div class="btn btn-green cursor-pointer">
            <span v-if="value">Selected File: {{ value.name }}</span>
            <span v-else>Select File</span>
        </div>
        <input class="hidden" type="file" @change="handleFileChange">
    </label>
</template>

<script>
export default {
    props: {
        value: File,
    },
    methods: {
        handleFileChange (e) {
            this.$emit('input', e.target.files[0])
        },
    },
}
</script>
