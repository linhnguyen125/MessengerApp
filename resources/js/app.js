/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import App from "./App.vue";
import router from "./router";
import "./filters";
import "./services/confetti";

require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$axios = axios;
Vue.prototype.$Echo = Echo;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    render: (h) => h(App),
    router,
    data: {
        user: window.__app__.user, // we always have user if they login as we return user object in app.blade.php
        rooms: window.__app__.rooms,
        emojis: window.__app__.emojis,
        appName:
            "Realtime Chat | Laravel, VueJS, Redis, Laravel Echo, SocketIO",
    },
}).$mount("#app");
