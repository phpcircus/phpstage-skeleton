export default {
    data () {
        return {
            errorField: 'id',
            errorBag: 'default',
        }
    },
    watch: {
        '$page.errors': {
            immediate: true,
            handler (newErrors) {
                if (this.$collection(newErrors).has(this.errorBag) && ! this.form) {
                    let errorBag = newErrors[this.errorBag];
                    if (this.$collection(errorBag).has(this.errorField)) {
                        this.$page.warning.warning = errorBag[this.errorField][0];
                    }
                }
                if (! this.$collection(newErrors).has(this.errorBag) && this.form && this.submitted) {
                    this.submitted = false;

                    return this.resetForm();
                }
            },
            deep: true,
        },
    },
}
