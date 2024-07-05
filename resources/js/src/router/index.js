import { createRouter, createWebHistory } from "vue-router";
import clientRouter from "./clientRouter";
import adminRouter from "./adminRouter";
import { authenStore } from "../store/authenStore";

const routes = [...clientRouter, ...adminRouter];


const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach( (to, from, next) => {
    if (to.meta.isAuth) {
        const auth = authenStore();
        const authenticated = auth.authenticated;
        if (authenticated) {
            next();
        } else {
            next({ name: 'quizz.auth.login' })
        }
    } else {
        next();

    }
})

export default router;
