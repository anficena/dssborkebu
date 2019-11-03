/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueAxios from 'vue-axios';
import axios from 'axios';


require('./bootstrap');

window.Vue = require('vue');
Vue.use(VueAxios, axios);

window.Fire = new Vue();


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-component', require('./components/Add.vue').default);
Vue.component('soc-component', require('./components/SocChart.vue').default);
Vue.component('monev_batu-component', require('./components/MonevBatuChart.vue').default);
Vue.component('select-component', require('./components/Select.vue').default);
Vue.component('iklim-component', require('./components/Iklim.vue').default);
Vue.component('perawatan-component', require('./components/Perawatan.vue').default);
Vue.component('kajian-component', require('./components/Kajian.vue').default);
Vue.component('flora-component', require('./components/Flora.vue').default);
Vue.component('kedalaman-sumur-component', require('./components/KedalamanSumurPenduduk.vue').default);
Vue.component('pengunjung-component', require('./components/Pengunjung.vue').default);
Vue.component('kajian-count-component', require('./components/KajianCount.vue').default);
Vue.component('publikasi-content-component', require('./components/PublikasiContent.vue').default);
Vue.component('kedalaman-resapan-component', require('./components/KedalamanSumurResapan.vue').default);
Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});