export default {
    methods: {
        // Check if the given path(s) are part of the current url
        isPath (...urls) {
            if (urls[0] === '') {
                return location.pathname.substr(1) === '';
            }

            return urls.filter(url => location.pathname.substr(1).startsWith(url)).length;
        },
        pathEndsWith (end) {
            return location.pathname.endsWith(end);
        },
    }
}
