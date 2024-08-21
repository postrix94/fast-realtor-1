import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
const app = createApp({});

import {permissionsMixin} from "./mixins/permission.js";
app.mixin(permissionsMixin)

import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import 'element-plus/theme-chalk/dark/css-vars.css';

import {successNotify, errorNotify, infoNotify, warningNotify} from "./settings/notify.js";
app.config.globalProperties.$successNotify = successNotify;
app.config.globalProperties.$errorNotify = errorNotify;
app.config.globalProperties.$infoNotify = infoNotify;
app.config.globalProperties.$warningNotify = warningNotify;

import Login from "./views/login/Login.vue";
import LoginAdmin from "./views/login/LoginAdmin.vue";
import Home from "./views/home/Home.vue";
import Ads from "./views/ads/Ads.vue";
import AdsEdit from "./views/ads/AdsEdit.vue";
import Menu from "./components/navigation/Menu.vue";
import AdsAll from "./views/ads/AdsAll.vue";

app.component("Login", Login);
app.component("LoginAdmin", LoginAdmin);
app.component("Home", Home);
app.component("Ads", Ads);
app.component("AdsEdit", AdsEdit);
app.component("Navigation", Menu);
app.component("AdsAll", AdsAll);

app.use(ElementPlus);
app.mount("#app");
