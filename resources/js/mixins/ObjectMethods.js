export default {
    methods: {
        isObjectEmpty (obj) {
            return this.$collection(obj).isEmpty();
        },
        objectContains (obj, needle) {
            return this.$collection(obj).has(needle);
        },
    },
}
