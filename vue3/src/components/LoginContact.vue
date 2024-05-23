
<template>
    <a-row type="flex" justify="center" align="middle" style="height: 400px">
        <a-col  >
            <a-space direction="vertical">
                <a-input addon-before="User: " v-model:value="userName" />
                <a-input-password addon-before="Passwd: " v-model:value="passwd" />
                
                <div style="display:flex; justify-content:center">
                    <a-button type="primary" @click="loginFun"  >登录</a-button>
                </div>
            </a-space>
        </a-col>
    </a-row>


</template>

<script setup>
import axios from "axios";
import { useStore } from 'vuex';

import { ref} from 'vue';
import router from "../route/router";

// axios.defaults.withCredentials = true; // 设置withCredentials为true


// 用户名,和密码
const userName = ref('hdy'); // 预设值
const passwd = ref('123456');


localStorage.setItem('userInfo', JSON.stringify({ id: 1, name: 'hdy' }));


const store = useStore();

// 登录
const loginFun = () => {
    if (!userName.value || !passwd.value) {
        alert("信息,不完整");
    } else {
        let hostName = store.getters.getHostName;
        // console.log(hostName);

        let sendData = {
            'userName' : userName.value,
            'passwd' : passwd.value,
        };
        axios.post( hostName +  "/contact/index/index/user/checkLogin", sendData)
        .then(response => {
            if (response.data.result == 'success') {
                console.log(response);
                let data = response.data.data;

                let uid = data['uid'];
                let userName = data['userName'];
                let phone = data['phone'];

                store.commit('setUser', {key:'uid', val:uid});
                store.commit('setUser', {key:'userName', val:userName});
                store.commit('setUser', {key:'phone', val:phone});

                // console.log(store.getters.getUser);
    
                router.push({name: 'HomeContact' });

            } else {
                alert('登录失败');
            }

        })
        .catch(error => {
            console.log(error);
        });

        // router.push("/success");
        // window.location.href="/success.html";
    }
};



</script>


<style>

</style>