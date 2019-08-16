export default {
    methods: {
        hideDropdown () {
            this.$dispatch('dropdown-should-close');
        },
    },
}
