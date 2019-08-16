<template>
    <vue-snotify />
</template>

<script>
export default {
    watch: {
        '$page.success': {
            handler (value) {
                if (value.message) {
                    this.$snotify.clear();
                    this.$snotify.success(value.message, 'Success!');
                }
            },
            deep: true,
        },
        '$page.warning': {
            handler (value) {
                if (value.message) {
                    this.$snotify.clear();
                    this.$snotify.error(value.message, 'Oops!');
                }
            },
            deep: true,
        },
        '$page.info': {
            handler (value) {
                if (value.message) {
                    this.$snotify.clear();
                    this.$snotify.info(value.message, 'Information:');
                }
            },
            deep: true,
        },
    },
    mounted () {
        if (this.$page.success.message) {
            this.$snotify.clear();
            this.$snotify.success(this.$page.success.message, 'Success!');
        }
        if (this.$page.warning.message) {
            this.$snotify.clear();
            this.$snotify.error(this.$page.warning.message, 'Oops!');
        }
        if (this.$page.info.message) {
            this.$snotify.clear();
            this.$snotify.info(this.$page.info.message, 'Information:');
        }
    },
}
</script>
