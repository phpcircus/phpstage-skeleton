export default {
    data () {
        return {
            errorBag: 'default',
        }
    },
    methods: {
        getErrors (field) {
            let errors = this.$collection(this.$page.errors);
            if (errors.has(this.errorBag)) {
                let errorBag = this.$collection(errors.get(this.errorBag));
                if (errorBag.has(field)) {
                    return errorBag.get(field);
                }
            }

            return [];
        },
    },
}
