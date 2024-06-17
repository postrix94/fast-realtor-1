import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import 'element-plus/theme-chalk/dark/css-vars.css';

const app = createApp({});

import {successNotify, errorNotify, infoNotify, warningNotify} from "./settings/notify.js";
app.config.globalProperties.$successNotify = successNotify;
app.config.globalProperties.$errorNotify = errorNotify;
app.config.globalProperties.$infoNotify = infoNotify;
app.config.globalProperties.$warningNotify = warningNotify;

import Test from "./components/Test.vue";
app.component("Test", Test);

import Login from "./views/login/Login.vue";
import LoginAdmin from "./views/login/LoginAdmin.vue";

app.component("Login", Login);
app.component("LoginAdmin", LoginAdmin);

app.use(ElementPlus);
app.mount("#app");
