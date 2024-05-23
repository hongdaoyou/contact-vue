
<template>
    <!-- <a-row>
        <a-col>
            <a-input addon-before="个人的姓名: "> </a-input>
        </a-col>
    </a-row>
    <div>
        <label>姓名: </label><span v-html="userName"></span> <br>
        <label>手机号: </label><span v-html="phone"></span>
    </div> -->

    <a-card title="用户信息" >
        <a-row justify="center">
            <a-col>
                <a-form >
                    <a-form-item  >
                        <a-input :disabled="!editMode" addon-before="用户名: " v-model:value="userName"></a-input>
                    </a-form-item>

                    <a-form-item  >
                        <a-input :disabled="!editMode" addon-before="手机号: " v-model:value="phone"></a-input>
                    </a-form-item>
                    
                </a-form>

            </a-col>

        </a-row>

        <div style="display:flex; justify-content: center;">
            <a-button v-if="editMode" type="primary" @click="handleSave">保存</a-button>
            <a-button v-if="!editMode" @click="handleEdit">编辑</a-button> 
        </div>

            
    </a-card>

</template>

<script setup>

import { ref } from "vue";
import { useStore } from "vuex";
import axios from "axios";
const store = useStore();

// axios.defaults.withCredentials = true; // 设置withCredentials为true


let uid = store.getters.getUser['uid'];
let hostName = store.getters.getHostName;

var userName = ref();
var phone = ref();


var editMode = ref(false);

// 编辑
const handleEdit = () => {
    editMode.value = true;
}

// 保存
const handleSave = () => {
    editMode.value = false;

    if (userName  && phone ) {
    } else {
        alert("信息,不完整");
        return;
    }

    var data = {
        'userName':userName.value,
        'phone' : phone.value
    }
    // 发送的数据
    let sendData = {
        'uid' : uid,
        'data': data
    };

    axios.post( hostName +  "/contact/index/index/user/update_my_info", sendData)
    .then(response => {
        if (response.data.result == 'success') {
            console.log(response);
            let data = response.data.data;

            // let uid = data['uid'];
            // userName.value = data['userName'];
            // phone.value = data['phone'];

            // store.commit('setUser', {key:'uid', val:uid});
            store.commit('setUser', {key:'userName', val:userName.value});
            store.commit('setUser', {key:'phone', val:phone.value});

            // console.log(store.getters.getUser);

            // userName.value = userName;
            // phone.value = phone;

        } else {
            // alert('获取失败');
        }

        alert(response.data.msg)
    })
    .catch(error => {
        console.log(error);
    });

}

const getUserInfo = () => {

    let sendData = {
        'uid' : uid,
    };
    axios.post( hostName +  "/contact/index/index/user/get_userInfo", sendData)
    .then(response => {
        if (response.data.result == 'success') {
            console.log(response);
            let data = response.data.data;

            let uid = data['uid'];
            userName.value = data['userName'];
            phone.value = data['phone'];

            store.commit('setUser', {key:'uid', val:uid});
            store.commit('setUser', {key:'userName', val:userName.value});
            store.commit('setUser', {key:'phone', val:phone.value});

            // console.log(store.getters.getUser);

            // userName.value = userName;
            // phone.value = phone;

        } else {
            alert('获取失败');
        }

    })
    .catch(error => {
        console.log(error);
    });

};

getUserInfo();


</script>
