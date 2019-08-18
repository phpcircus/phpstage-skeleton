import collect from 'collect.js';

export default {
    install (Vue, options) {
        Vue.prototype.$collection = input => {
            return collect(input);
          }
    },
}
