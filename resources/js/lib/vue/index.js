import Vue from 'vue';
import store from '@/store';
import VueHead from 'vue-head';
import { config } from 'Config';
import Dates from 'Mixins/Dates';
import VueStash from 'vue-stash';
import VModal from 'vue-js-modal';
import PortalVue from 'portal-vue';
import Routing from 'Mixins/Routing';
import Objects from '@/plugins/Objects';
import Dialogs from '@/plugins/Dialogs';
import GetsErrors from 'Mixins/GetsErrors';
import ParsesUrls from 'Mixins/ParsesUrls';
import VueWindowSize from 'vue-window-size';
import Dispatcher from '@/plugins/Dispatcher';
import ObjectMethods from 'Mixins/ObjectMethods';
import { InertiaApp } from '@inertiajs/inertia-vue';
import Snotify, { SnotifyPosition } from 'vue-snotify';
import HandlesDropdowns from 'Mixins/HandlesDropdowns';
import ScreenChanges from 'Mixins/HandlesScreenSizeChanges';

// Use mixins
Vue.mixin(Dates);
Vue.mixin(Routing);
Vue.mixin(ParsesUrls);
Vue.mixin(GetsErrors);
Vue.mixin(ScreenChanges);
Vue.mixin(ObjectMethods);
Vue.mixin(HandlesDropdowns);


// Use Dispatcher
Vue.use(Dispatcher);

// Use Dialogs
Vue.use(Dialogs);

// Use Objects
Vue.use(Objects);

// Use VueHead
Vue.use(VueHead, {
    separator: '|',
    complement: config.appName,
  });

// Use PortalVue
Vue.use(PortalVue);

// Use Vue-Stash for state management
Vue.use(VueStash);

// Use Vue-Modal
Vue.use(VModal, {
    componentName: 'modal-component',
});

// Use vue-window-size
Vue.use(VueWindowSize);

// Use Snotify for notifications
Vue.use(Snotify, {
    toast: {
        position: SnotifyPosition.rightTop,
        timeout: 3000,
        showProgressBar: true,
        closeOnClick: false,
        pauseOnHover: true,
        backdrop: 0.7,
    }
});

// Use InertiaApp
Vue.use(InertiaApp);

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
            // Echo.channel('channel')
            //     .listen('.event', e => {
            //        //
            //     });
        },
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import (`@/Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
