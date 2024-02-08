import { createRouter, createWebHistory } from 'vue-router';
import IndexComponent from '@/views/index/IndexComponent';
import LoginComponent from '@/views/login/LoginComponent';
import PrincipalComponent from '@/views/principal/PrincipalComponent';

const routes = [
    {
        path: '/',
        component: IndexComponent,
        name: 'index'
    },
    {
        path: '/login',
        component: LoginComponent,
        name: 'login'
    },
    {
        path: '/principal',
        component: PrincipalComponent
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;