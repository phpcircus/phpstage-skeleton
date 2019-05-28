<template>
    <vue-snotify />
</template>

<script>
export default {
    watch: {
        '$page.success': {
            handler (value) {
                if (value.success) {
                    this.$snotify.clear();
                    this.$snotify.success(value.success, 'Success!');
                }
            },
            deep: true,
        },
        '$page.warning': {
            handler (value) {
                if (value.warning) {
                    this.$snotify.clear();
                    this.$snotify.error(value.warning, 'Oops!');
                }
            },
            deep: true,
        },
        '$page.info': {
            handler (value) {
                if (value.info) {
                    this.$snotify.clear();
                    this.$snotify.error(value.info, 'Information:');
                }
            },
            deep: true,
        },
    },
    mounted () {
        if (this.$page.success.success) {
            this.$snotify.clear();
            this.$snotify.success(this.$page.success.success, 'Success!');
        }

        if (this.$page.warning.warning) {
            this.$snotify.clear();
            this.$snotify.warning(this.$page.warning.warning, 'Oops!');
        }

        if (this.$page.info.info) {
            this.$snotify.clear();
            this.$snotify.info(this.$page.info.info, 'Information:');
        }
    },
}
</script>
