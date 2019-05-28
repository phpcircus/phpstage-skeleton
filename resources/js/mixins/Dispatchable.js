import Dispatcher from 'Events/hub';

export default {
    methods: {
        $dispatch (event, data = null) {
            Dispatcher.$emit(event, data);
        },
        $listen (event, callback) {
            Dispatcher.$on(event, callback);
        }
    }
}