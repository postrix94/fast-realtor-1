import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
const app = createApp({});

import {successNotify, errorNotify, infoNotify, warningNotify} from "./settings/notify.js";
app.config.globalProperties.$successNotify = successNotify;
app.config.globalProperties.$errorNotify = errorNotify;
app.config.globalProperties.$infoNotify = infoNotify;
app.config.globalProperties.$warningNotify = warningNotify;

import Test from "./components/Test.vue";
app.component("Test", Test);

app.mount("#app");
