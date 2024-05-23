
import { createApp } from "vue";

import HomeContact from "./components/HomeContact.vue";

import Antd from "ant-design-vue";

import store from "./store/store.js";
import router from "./route/router.js";

// 创建, vue对象
const app = createApp(HomeContact);

// app.config.devtools = true;

app.use(store);
app.use(Antd);
app.use(router);

// 挂载
app.mount('#app');


