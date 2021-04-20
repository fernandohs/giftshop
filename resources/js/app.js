require("./bootstrap");

import routes from "./routes";
import App from "./components/App.vue";

Vue.config.productionTip = false;
Vue.use(VueRouter);
Vue.use(Vuetify);

const router = new VueRouter(routes);

// router.beforeEach((to, from, next) => {
//     const authenticatedUser = null;
//     const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

//     // Check for protected route
//     if (requiresAuth && !authenticatedUser) next('login')
//     else next();
// });

const app = new Vue({
    el: "#app",
    components: { App },
    router: router,
    vuetify: new Vuetify()
});
