export default {
    computed : {
        permissions () {
            return this.$page.auth.user.can;
        },
    },
    methods: {
        can (permission) {
            if (this.contains(this.permissions, permission)) {
                return this.permissions[permission];
            }

            return false;
        },
    },
}
