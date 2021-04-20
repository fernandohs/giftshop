import Homepage from "../pages/Homepage.vue";
import About from "../pages/About.vue";
import Contact from "../pages/Contact.vue";
import Login from "../components/Login";    
import Userspage from "../pages/Userspage.vue";
import CategoriesPage from "../pages/Categoriespage.vue";
import ProductsPage from "../pages/ProductsPage.vue"
// import Sales from "../pages/Sales"
// import Categories from "../pages/Categories"

export default {
    mode: "history",
    routes: [
        {
            path: "/users",
            name: "users",
            component: Userspage
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
        {
            path: "/categories",
            name: "categories",
            component: CategoriesPage
        },
        {
            path: "/products",
            name: "products",
            component: ProductsPage
        },
        { path: "*", component: Login } // todo add not found page
    ]
};
