
import { createRouter,createWebHistory } from "vue-router";


// 导入组件
import FirstPage from '../components/FirstPage.vue';
import LoginContact from '../components/LoginContact.vue';

import HomeContact from '../components/HomeContact.vue';
import FriendContact from '../components/FriendContact.vue';
import PlaceContact from '../components/PlaceContact.vue';
import UserContact from '../components/UserContact.vue';


const routes = [
    { 
        path: '/',
        name: 'FirstPage',
        component: FirstPage
    },
    {
        path: '/HomeContact',
        name: 'HomeContact',
        component: HomeContact,
        children : [
            {
                path:'', // 默认组件
                name:"default",
                component:UserContact 
            },
            {
                path: 'FriendContact',
                name: 'FriendContact',
                component: FriendContact
            },
            {
                path: 'PlaceContact',
                name: 'PlaceContact',
                component: PlaceContact
            },
            {
                path: 'UserContact',
                name: 'UserContact',
                component: UserContact
            },
            
    ]
}
    
];


const router = createRouter({
    history: createWebHistory(),
    routes
});
  
export default router;

