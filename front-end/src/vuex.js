import Vuex from 'vuex';

export default new Vuex.Store({
    state: {
        user: {},
        qtd_posts: 0
    },

    getters: {
        user: (state) => {
            return state.user;
        },

        qtd_posts: (state) => {
            return state.qtd_posts;
        }
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        qtd_posts(context, qtd_posts) {
            context.commit('qtd_posts', qtd_posts);
        }
    },

    mutations: {
        user(state, user) {
            state.user = user
        },

        qtd_posts(state, qtd_posts) {
            state.qtd_posts = qtd_posts
        }
    }
    
});
