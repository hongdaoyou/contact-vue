import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

const state = {
    'userInfo':{},

    'hostName':'http://localhost:8000',
    // 'hostName':'https://localhost',
};

// 设置
const mutations = {
    setUser(state, payload) {
        // console.log(payload);
        const { key, val } = payload;
        // console.log(key, val);

        state.userInfo[key] = val;
    }
}

// 获取,当前存储的变量
const getters = {
    getUser(state) {
        return state.userInfo
    },
    getHostName(state) {
        // console.log("aa" , state.hostName);
        return state.hostName
    },
}

// 创建
const store = createStore({
    state, mutations, getters,
    plugins: [
        createPersistedState({
            // storage:window.sessionStorage
            storage:window.localStorage

        })
    ]
});


export default store;

