import Vue from 'vue';
import store from 'JS/store';
import Dates from 'Mixins/Dates';
import VueStash from 'vue-stash';
import Inertia from 'inertia-vue';
import VModal from 'vue-js-modal';
import PortalVue from 'portal-vue';
import ParsesUrls from 'Mixins/ParsesUrls';
import Dispatchable from 'Mixins/Dispatchable';
import Snotify, { SnotifyPosition } from 'vue-snotify';

// Use mixins
Vue.mixin({
    methods: {
         route: (...args) => window.route(...args).url(),
         isObjectEmpty: (obj) => ! Object.values(obj).length >= 1,
         objectContains: (obj, needle) => {
            if (typeof obj === 'object' && obj !== null) {
                return obj.hasOwnProperty(needle);
            }
            return false;
         },
    },
});
Vue.mixin(Dispatchable);
Vue.mixin(ParsesUrls);
Vue.mixin(Dates);

// Use PortalVue
Vue.use(PortalVue);

// Use Vue-Stash for state management
Vue.use(VueStash);

// Use Vue-Modal
Vue.use(VModal, { componentName: 'modal-component' });

// Use Snotify for notifications
Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        timeout: 3000,
        showProgressBar: true,
        closeOnClick: false,
        pauseOnHover: true,
    }
});

// Use Inertia
Vue.use(Inertia);

// Filters
Vue.filter('ucase', function (value) {
    return value ? value.toUpperCase() : '';
});

Vue.filter('capitalize', value => {
    if (typeof value !== 'string') return ''
    return value.charAt(0).toUpperCase() + value.slice(1)
});

if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
    Vue.config.productionTip = false;
}

let app = document.getElementById('app');

new Vue({
    data: { store },
    render: h => h(Inertia, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import (`@/Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
