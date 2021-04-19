require('./bootstrap');

import routes from './routes'
import App from './components/App.vue'



// Vue.component('hola-mundo', require('./components/HolaMundo.vue').default)
// Vue.component('form-text', require('./components/FormText.vue').default)
// Vue.component('form-test', require('./components/FormTest').default)



Vue.config.productionTip = false
Vue.use(VueRouter)
Vue.use(Vuetify)

const router = new VueRouter(routes);


router.beforeEach((to, from, next) => {
    const authenticatedUser = null;
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

    // Check for protected route
    if (requiresAuth && !authenticatedUser) next('login')
    else next();
});

const app = new Vue({
    el: '#app',
    components: { App },
    router: router,
    vuetify: new Vuetify()
})
