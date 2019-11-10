import Vue from 'vue';
import store from '@/store';
import VueHead from 'vue-head';
import { config } from 'Config';
import Dates from 'Mixins/Dates';
import VueStash from 'vue-stash';
import VModal from 'vue-js-modal';
import Dialogs from '@/plugins/Dialogs';
import GetsErrors from 'Mixins/GetsErrors';
import ParsesUrls from 'Mixins/ParsesUrls';
import VueWindowSize from 'vue-window-size';
import Dispatcher from '@/plugins/Dispatcher';
import ObjectMethods from 'Mixins/ObjectMethods';
import { InertiaApp } from '@inertiajs/inertia-vue';
import Snotify, { SnotifyPosition } from 'vue-snotify';
import HandlesDropdowns from 'Mixins/HandlesDropdowns';
import HandlesPermissions from 'Mixins/HandlesPermissions';
import ScreenChanges from 'Mixins/HandlesScreenSizeChanges';

// Use mixins
Vue.mixin(Dates);
Vue.mixin(ParsesUrls);
Vue.mixin(GetsErrors);
Vue.mixin(ScreenChanges);
Vue.mixin(ObjectMethods);
Vue.mixin(HandlesDropdowns);
Vue.mixin(HandlesPermissions);

Vue.mixin({
    methods: {
        route (...args) {
            return window.route(...args).url();
        },
        randomString () {
            return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        },
    },
});

// Use Dispatcher
Vue.use(Dispatcher);

// Use Dialogs
Vue.use(Dialogs);

// Use VueHead
Vue.use(VueHead, {
    separator: '|',
    complement: config.appName,
  });

// Use Vue-Stash for state management
Vue.use(VueStash);

// Use Vue-Modal
Vue.use(VModal, {
    componentName: 'modal-component',
});

// Use Snotify for notifications
Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        timeout: 1500,
        showProgressBar: true,
        closeOnClick: false,
        pauseOnHover: true,
        backdrop: 0.2,
    }
});

// Use InertiaApp
Vue.use(InertiaApp);

// Use vue-window-size
Vue.use(VueWindowSize);

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
    Vue.config.silent = false;
    Vue.config.productionTip = false;
}

let app = document.getElementById('app');

new Vue({
    data: { store },
    mounted () {
        this.listenForEvents();
    },
    methods: {
        listenForEvents () {
            /* global Echo */
            //
        },
    },
    render: h => {
        return h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => import (`@/Pages/${name}`).then(module => module.default),
                transformProps: props => {
                    return {
                        ...props,
                    }
                },
            },
        })
    },
}).$mount(app)
