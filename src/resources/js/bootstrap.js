import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
const app = createApp({});

import Test from "./components/Test.vue";
app.component("Test", Test);

app.mount("#app");
