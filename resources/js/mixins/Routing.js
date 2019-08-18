export default {
    methods: {
        route (...args) {
            return window.route(...args).url();
        },
    },
}
