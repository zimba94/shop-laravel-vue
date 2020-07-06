import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
export default new Router({
    routes: [{
            path: '/',
            name: 'home',
            component: require('./views/SecondBannerComponent').default
        },
        {
            path: '/products',
            name: 'products',
            component: require('./views/ProductsComponent').default
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: require('./views/CheckoutComponent').default
        },
        {
            path: '/account',
            name: 'account',
            component: require('./views/AccountComponent').default
        },
        {
            path: ':id',
            name: 'single',
            component: require('./views/SingleComponent').default,
            props: true
        },
        {
            path: '/register',
            name: 'register',
            component: require('./views/RegisterComponent').default
        },
        {
            path: '/users',
            name: 'users',
            component: require('./views/UserComponent').default
        },
        {
            path: '/productsAdm',
            name: 'productsAdm',
            component: require('./views/ProductsAdmComponent').default
        },
        {
            path: '*',
            component: require('./views/FirstBannerComponent')
        }
    ],
    mode: 'history'
});