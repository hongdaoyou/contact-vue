<template>
    <a-layout>
        <a-layout-sider :style="layoutSider">
            <a-menu :style="{backgroundColor:'pink'} " v-model:selectedKeys="selectedKey" :items="items"  @click="fun">
            </a-menu>
            
        </a-layout-sider>

        <a-layout-content :style="layoutContent"  style="overflow: auto">
            <!-- <FriendContact></FriendContact> -->
            <router-view ></router-view>
        </a-layout-content>

    </a-layout>

</template>

<script setup>

// import FriendContact from "./FriendContact.vue";

import { ref } from "vue";
import { useRouter } from "vue-router";

import { layoutSider, layoutContent } from "./style.vue";

import UserContact from "./UserContact.vue";

const selectedKey = ref([]);  // 默认,选择 UserContact

const router = useRouter();

const items = ref([
    {
        key:'UserContact',
        label:'个人信息'
        // title:'title-1',
    }, {
        key:'FriendContact',
        label:'朋友信息'
    }, {
        key:'PlaceContact',
        label:'去过的地方'
    },
    

]);

const fun = (event) => {
    console.log('/' + event.key);

    // router.push('/success/' +  event.key);
    router.push({name: event.key });
}
// fun()

</script>

