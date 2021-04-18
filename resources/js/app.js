require('./bootstrap');
Vue.config.productionTip = false

// Vue.component('hola-mundo', require('./components/HolaMundo.vue').default)
// Vue.component('form-text', require('./components/FormText.vue').default)
Vue.component('form-test', require('./components/FormTest').default)
const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
}) 