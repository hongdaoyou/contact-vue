<template>

    <a-row type="flex" justify="center" align="middle" style="height: 80px">
        <a-col>
            <a-button type="primary" @click="openModalFun" >添加,好友的信息</a-button>
        </a-col>

    </a-row>

    <a-modal v-model:open="openModal" @ok="addFriend">
        <a-row type="flex" justify="center" align="middle" >
            <a-col :span="12" >
                <a-space direction="vertical">
                    <a-input addon-before="用户名: " v-model:value="userName" />
                    <a-input addon-before="手机号: " v-model:value="phone" />
                    <a-input addon-before="地址: " v-model:value="addr"  />
                </a-space>

            </a-col>
        </a-row>

    </a-modal>

    
    <a-table :data-source="dataSource" :columns="colData" :pagination="false" >
        <template v-slot:bodyCell="{ text,column,record }">
            <span v-if="column.key == 'operation'">
                <a-button type="primary" @click="handleDelete(record)">删除</a-button>
                <a-button  @click="handleEdit(record)">修改</a-button>
            </span>

            <span v-else>
                {{ text }}
            </span>

        </template>

    </a-table>

    
    <a-modal v-model:open="openModal_Modify" @ok="modifyFriendSend">
        <a-row type="flex" justify="center" align="middle" >
            <a-col :span="12" >
                <a-space direction="vertical">
                    <a-input addon-before="用户名: " v-model:value="userName" />
                    <a-input addon-before="手机号: " v-model:value="phone" />
                    <a-input addon-before="地址: " v-model:value="addr"  />
                </a-space>

            </a-col>
        </a-row>

    </a-modal>


    <a-pagination :total="totalNum" :pageSize="perPageNum" :pageSizeOptions="[perPageNum]" v-model:current="curPage"  :showQuickJumper="true" @change="pageChange" style="display:flex; justify-content:center; margin:10px"></a-pagination>

</template>

<script setup>

import { useRouter } from "vue-router";

// import a1 from "./a.vue";
import axios from "axios";
import { watch, ref , computed, onMounted} from 'vue';

import { useStore } from "vuex";

// axios.defaults.withCredentials = true; // 设置withCredentials为true

// 路由
const router = useRouter();


const store = useStore();

let hostName = store.getters.getHostName;

const userName = ref();
const phone = ref();
const addr = ref();

const dataSource = ref();

// 分页
var perPageNum = ref(6); // 每页请求的个数
const curPage= ref();
const totalNum = ref();


let uid = store.getters.getUser['uid'];

// 打开的
var openModal = ref(false);

var openModalFun = () => {
    openModal.value = true;
}

const openModal_Modify = ref(false) // 弹出框

var friendUID = 0;

const handleEdit = (record) => {
    // 编辑按钮点击事件处理逻辑
    console.log('编辑', record);

    userName.value = record.userName;
    phone.value = record.phone;
    addr.value = record.addr;
    friendUID = record.uid;

    openModal_Modify.value = true;
};

// 修改
const modifyFriendSend = () => {

    if (!userName.value  || !phone.value || !addr.value) {
        alert("信息,不完整");
    } 
        // return;
    let data = {
        uid: friendUID,
        userName:userName.value,
        phone:phone.value,
        addr:addr.value,
    };

    let sendData= {
        uid: uid,
        data:data,
    };

    axios.post(hostName + "/contact/index/index/friend/update_friend",sendData)
    .then( (response) => {
        if (response.data.result == 'success') {
            // let data = response.data;
            // dataSource.value = response.data.data;
    
            alert(response.data.msg);

            // 关闭,对话框
            openModal_Modify.value = false;
        
            // router.push({name: 'FriendContact' });
            location.reload();

        } else {
            alert(response.data.msg);
        }
    })
    .catch((error)=>{
        console.log(error);
    })
}

const handleDelete = (record) => {
    // 删除按钮点击事件处理逻辑
    console.log('删除', record);
    
    let data = {
        uid: record.uid,
    };

    // console.log(data.uid);

    let sendData= {
        uid: uid,
        data:data,
    };

    axios.post(hostName + "/contact/index/index/friend/delete_friend",sendData)
    .then( (response) => {
        if (response.data.result == 'success') {

        }
        alert(response.data.msg);

        location.reload();
    })
    .catch((error)=>{
        console.log(error);
    })
};


const colData = [{
        title:'姓名',
        dataIndex:'userName',
        key:'userName',
    },{
        title:'手机号',
        key:'phone',
        dataIndex:'phone',
    },{
        title:'住址',
        dataIndex:'addr',
        key:'addr',
    }, 
    {
        title: '操作',
        dataIndex: 'operation',
        key:'operation',
    }
];


// 请求,数据
const reqData = (startNum, num)=> {

    let sendData= {
        uid: uid,
        start:startNum, // 请求的起点
        num : perPageNum.value // 总共请求的个数
    };
    axios.post(hostName + "/contact/index/index/friend/get_friend_list",sendData)
    .then( (response) => {
        if (response.data.result == 'success') {
            // let data = response.data;
            dataSource.value = response.data.data;

            totalNum.value = response.data.totalNum;
            
            // console.log(response.data.totalNum);

        }
    })
    .catch((error)=>{
        console.log(error);
    })
}


// 第一次,请求
reqData(0, perPageNum);

// onMounted(reqData());

const addFriend = (event) => {
    // alert('111');
    // return;
    // userName.value = 'hdy';
    // phone.value = '手机啊';
    // addr.value = '地址啊';

    // return;

    if (!userName.value  || !phone.value || !addr.value) {
        alert("信息,不完整");
    } else {
        // console.log(store.getters);

        if (!uid) {
            alert('未登录');
            return;
        }
        // return;

        let sendData= {
            uid: uid,
            data : {
                userName:userName.value,
                phone:phone.value,
                addr:addr.value,
            }
        }

        axios.post(hostName + "/contact/index/index/friend/add_friend", sendData)
        .then(response => {
            // if (response.data.result == 'success') {
            //     console.log(response);
            // }

            console.log(response);
            alert(response.data.msg);
            openModal.value = false;
        })
        .catch(error => {
            console.log(error);
        });
        // window.location.href="/success.html";
    }
};

// 分页、排序、筛选变化时触发
const pageChange = (page, pageSize) => {
    curPage.value = page;
    reqData((page-1) * perPageNum.value, perPageNum.value);

}

</script>

