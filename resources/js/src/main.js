import { createApp } from 'vue'
import App from './App.vue'
import "bootstrap/dist/css/bootstrap.min.css"
import router from './router';
import axios from 'axios';
import { createPinia } from 'pinia'
import VueCountdown from '@chenfengyuan/vue-countdown';


const pinia = createPinia()
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import { Radio, Table, Button } from 'ant-design-vue';

const app = createApp(App);
window.axios = axios;
axios.defaults.withCredentials = true; // chia se cookie


app.use(router)
app.use(pinia)
app.use(ElementPlus)
app.use(Radio);
app.use(Table);
app.use(Button);
app.component(VueCountdown.name, VueCountdown);

for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component)
}
app.mount("#app");
// createApp(App).mount('#app')
