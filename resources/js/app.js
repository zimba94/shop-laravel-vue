require('./bootstrap');
window.Vue = require('vue');
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('app', require('./components/AppComponent.vue').default);
Vue.component('footerv', require('./components/FooterComponent.vue').default);
Vue.component('footera', require('./components/FooterAdminComponent.vue').default);
Vue.component('admin', require('./components/AdminComponent.vue').default);
// Vue.component('first-banner', require('./views/FirstBannerComponent.vue').default);
// Vue.component('second-banner', require('./views/SecondBannerComponent.vue').default);
// Vue.component('products', require('./views/ProductsComponent.vue').default);
// Vue.component('checkout', require('./views/CheckoutComponent.vue').default);
// Vue.component('account', require('./views/AccountComponent.vue').default);
// Vue.component('single', require('./views/SingleComponent.vue').default);
// Vue.component('register', require('./views/RegisterComponent.vue').default);
import router from './routes';

const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        page: 0,
    },
    router
});