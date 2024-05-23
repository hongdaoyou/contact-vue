import { createApp, defineComponent } from "vue";
import { createRouter,createWebHistory } from "vue-router";
import PlaceContact from './components/PlaceContact.vue';
import HeaderContact from './components/HeaderContact.vue';
import FirstContact from './components/FirstContact.vue';

var app = createApp();

// 创建,路由实例
var router1 = createRouter({
    history: createWebHistory(),
    
    // 路由信息
    routes: [
        { path: '/test.html', component: PlaceContact },

    ]
});

app.use(router1);
app.mount('#app');
