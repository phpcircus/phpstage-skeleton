import Dispatcher from 'Events/hub';

export default {
    install (Vue, options) {
        Vue.prototype.$dispatcher = Dispatcher;
        Vue.prototype.$listen = (event, callback) => Dispatcher.$on(event, callback);

        Vue.prototype.$dispatch = (event) => Dispatcher.$emit(event);
    },
}
