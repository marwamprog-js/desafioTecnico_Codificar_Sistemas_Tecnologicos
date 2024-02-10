import Vuex from 'vuex';

export default new Vuex.Store({
    state: {
        user: {},
        token: ""
    },

    getters: {
        user: (state) => {
            return state.user;
        },

        token: (state) => {
            return state.token;
        }
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        token(context, token) {
            context.commit('token', token);
        }
    },

    mutations: {
        user(state, user) {
            state.user = user
        },

        token(state, token) {
            state.token = token
        }
    }
    
});
