import Vuex from 'vuex';

export default new Vuex.Store({
    state: {
        user: {},
        qtd_posts: 0,
        token: "",
        isLogged: false
    },

    getters: {
        user: (state) => {
            return state.user;
        },

        qtd_posts: (state) => {
            return state.qtd_posts;
        },

        token: (state) => {
            return state.token;
        },

        isLogged: (state) => {
            return state.isLogged;
        }
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        qtd_posts(context, qtd_posts) {
            context.commit('qtd_posts', qtd_posts);
        },

        token(context, token) {
            context.commit('token', token);
        },

        isLogged(context, isLogged) {
            context.commit('isLogged', isLogged);
        }
    },

    mutations: {
        user(state, user) {
            state.user = user
        },

        qtd_posts(state, qtd_posts) {
            state.qtd_posts = qtd_posts
        },

        token(state, token) {
            state.token = token
        },

        isLogged(state, isLogged) {
            state.isLogged = isLogged
        }
    }
    
});
