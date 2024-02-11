import { createRouter, createWebHistory } from 'vue-router';

import IndexComponent from '@/views/index/IndexComponent';
import LoginComponent from '@/views/login/LoginComponent';
import PrincipalComponent from '@/views/principal/PrincipalComponent';
import NovoPostComponent from '@/views/meus-posts/NovoPostComponent';
import AlterarPostComponent from '@/views/meus-posts/AlterarPostComponent';
import PostsComponent from '@/views/meus-posts/PostsComponent';
import MeusDadosComponent from '@/views/meus-dados/MeusDadosComponent';

const routes = [
    {
        path: '/',
        component: IndexComponent,
        name: 'index',
        meta: { auth: false }
    },
    {
        path: '/login',
        component: LoginComponent,
        name: 'login',
        meta: { auth: false }
    },
    {
        path: '/principal',
        component: PrincipalComponent,
        name: 'principal',
        meta: { auth: true }
    },
    { 
        path: '/posts', 
        component: PostsComponent, 
        name: 'posts', 
        meta: { auth: true }
    },
    { 
        path: '/posts/novo', 
        component: NovoPostComponent, 
        name: 'novo-post', 
        meta: { auth: true }
    },
    { 
        path: '/posts/:id/atualizar', 
        component: AlterarPostComponent, 
        name: 'atualizar-post',
        meta: { auth: true } 
    },
    {
        path: '/meus-dados',
        component: MeusDadosComponent,
        name: 'meus-dados',
        meta: { auth: true }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    let rotaProtegida = to.meta.auth;
    let isLogged = localStorage.getItem('isLogged');
    
    if(rotaProtegida && isLogged == "false") {
        next('/login');
    } else {
        next();
    }
});

export default router;