import Vuex from 'vuex';

export default new Vuex.Store({
    state: {
        user: {},
        postUpdate: {}
    },

    getters: {
        user: (state) => {
            return state.user;
        },

        postUpdate: (state) => {
            return state.postUpdate;
        }
    },

    actions: {
        user(context, user) {
            context.commit('user', user);
        },

        postUpdate(context, postUpdate) {
            context.commit('postUpdate', postUpdate);
        }
    },

    mutations: {
        user(state, user) {
            state.user = user
        },

        postUpdate(state, postUpdate) {
            state.postUpdate = postUpdate
        }
    }
    
});
