import { isEmpty, has, size, find } from 'lodash';

export default {
    methods: {
        isEmpty (obj) {
            return isEmpty(obj);
        },
        contains (obj, needle) {
            return has(obj, needle);
        },
        count (obj) {
            return size(obj);
        },
        firstWhere (obj, test) {
            return find(obj, test);
        },
    },
}
