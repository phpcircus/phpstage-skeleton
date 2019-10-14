import { has, get } from 'lodash'

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
                // if the shared errors include the errors the component is expecting
                // and the page does not contain a form where errors can be shown
                // then get needed errors & assign to the specified variable
                if (has(newErrors, this.errorBag) && ! this.form) {
                    let errorBag = get(newErrors, this.errorBag);

                    // if these errors contain the specific error the page is looking for
                    // we set the warning message so it can be displayed to the user
                    if (has(errorBag, this.errorField)) {
                        this.$page.warning.warning = get(errorBag, this.errorField[0]);
                    }
                }

                // if there are no errors and there is a form that has already been submitted
                // we just set submitted to false, reset the form and hit the page again
                if (! has(newErrors, this.errorBag) && this.form && this.submitted) {
                    this.submitted = false;
                    this.resetForm();
                    this.$inertia.visit(window.location.pathname, { method: 'get', data: {}, preserveScroll: false, preserveState: false });
                }
            },
            deep: true,
        },
    },
}
