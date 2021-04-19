import Homepage from "../pages/Homepage.vue";
import About from "../pages/About.vue";
import Contact from "../pages/Contact.vue";
import Login from "../components/Login";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Homepage
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/contact",
            name: "contact",
            component: Contact,
            meta: {
                requiresAuth: true
            }
        },
        { path: "*", component: Login } // todo add not found page
    ]
};
