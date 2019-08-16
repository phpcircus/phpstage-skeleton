import collect from 'collect.js';

export default {
    install (Vue, options) {
        Vue.$collection = input => {
            return collect(input);
          }
    },
}
