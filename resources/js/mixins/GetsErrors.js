export default {
    methods: {
        getErrors (field) {
            if (this.$page.errors[this.errorBag]) {
                return this.$page.errors[this.errorBag][field];
            }

            return [];
        },
    },
}
