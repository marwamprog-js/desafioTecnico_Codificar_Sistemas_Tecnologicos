import { createRouter, createWebHistory } from 'vue-router';
import IndexComponent from '@/views/index/IndexComponent';
import LoginComponent from '@/views/login/LoginComponent';
import PrincipalComponent from '@/views/principal/PrincipalComponent';
import NovoPostComponent from '@/views/meus-posts/NovoPostComponent';
import AlterarPostComponent from '@/views/meus-posts/AlterarPostComponent';
import PostsComponent from '@/views/meus-posts/PostsComponent';

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
        component: PrincipalComponent,
        name: 'principal',
    },
    { 
        path: '/posts', 
        component: PostsComponent, 
        name: 'posts', 
    },
    { 
        path: '/posts/novo', 
        component: NovoPostComponent, 
        name: 'novo-post' 
    },
    { 
        path: '/posts/:id/atualizar', 
        component: AlterarPostComponent, 
        name: 'atualizar-post' 
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;