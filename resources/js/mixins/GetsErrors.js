import { has, get } from 'lodash';

export default {
    data () {
        return {
            errorBag: 'default',
        }
    },
    methods: {
        getErrors (field) {
            let errors = this.$page.errors;

            // if the errors contain the expected errors, we get those
            // errors & assign to a variable for further processing
            if (has(errors, this.errorBag)) {
                let errorBag = get(errors, this.errorBag);

                // if the field we need is present in the errors we
                // return the associated error to the component
                if (has(errorBag, field)) {
                    return get(errorBag, field);
                }
            }

            return [];
        },
    },
}
