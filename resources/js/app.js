require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import VueSimplemde from 'vue-simplemde'
import md from 'marked'
Vue.use(Vuetify)
Vue.component('vue-simplemde', VueSimplemde)

import User from './Helper/User'
import Exception from './Helper/Exception'
window.User = User
window.Exception = Exception
window.md = md
window.EventBus = new Vue();

console.log(User.loggedIn())

Vue.component('app-home', require('./components/AppHome.vue').default);

import router from './Router/router';
const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
});
