import Homepage from "../pages/Homepage.vue"
import About from "../pages/About.vue"
import Contact from "../pages/Contact.vue"
import Login from "../components/Login"
// import Userspage from "../page/Userspage.vue"
import Userspage from "../pages/Userspage.vue"


// import ProductsPage from "../pages/ProductsPage"
// import Sales from "../pages/Sales"
// import Categories from "../pages/Categories"


export default {
    mode: "history",
    routes: [
        {
            path:"/users",
            name: "users",
            component:Userspage
        },
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
