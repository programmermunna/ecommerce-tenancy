import { createRouter, createWebHashHistory } from "vue-router";
import register from '../App/Auth/register.vue';
import login from '../App/Auth/login.vue';

const routes = [
    { path:'/register', name:'register', component: register },
    { path:'/login', name:'login', component: login }
];
const router = createRouter({
    history: createWebHashHistory(),
    routes,
})
export default router;