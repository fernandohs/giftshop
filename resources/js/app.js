require('./bootstrap');

import routes from './routes'
import App from './components/App.vue'



// Vue.component('hola-mundo', require('./components/HolaMundo.vue').default)
// Vue.component('form-text', require('./components/FormText.vue').default)
// Vue.component('form-test', require('./components/FormTest').default)



Vue.config.productionTip = false
Vue.use(VueRouter)
Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    components: { App },
    router: new VueRouter(routes),
    vuetify: new Vuetify()
})
