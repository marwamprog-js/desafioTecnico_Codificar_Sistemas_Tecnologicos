import { createRouter, createWebHistory } from 'vue-router';
import IndexComponent from '@/views/index/IndexComponent';
import LoginComponent from '@/views/login/LoginComponent';
import PrincipalComponent from '@/views/principal/PrincipalComponent';
import PostsComponent from '@/views/posts/PostsComponent';
import MeusPostComponent from '@/views/meus-posts/MeusPostsComponent';
import NovoPostComponent from '@/views/meus-posts/NovoPostComponent';
import UsuarioPostsComponent from '@/views/meus-posts/UsuarioPostsComponent';

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
        children: [
            { path: '', component: PostsComponent },
            { path: 'meus-posts', component: MeusPostComponent, name: 'meus-posts', children: [
                { path: '', component: UsuarioPostsComponent, name: 'usuario-post' },
                { path: 'novo', component: NovoPostComponent, name: 'novo-post' },
            ]}
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;