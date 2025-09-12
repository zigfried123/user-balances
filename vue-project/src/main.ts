import 'bootstrap/dist/css/bootstrap.css';
import './assets/main.css'

import { BootstrapIconsPlugin } from "bootstrap-icons-vue";
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createPersistedState } from 'pinia-plugin-persistedstate';
import CarbonVue3 from '@carbon/vue';

import App from './App.vue'
import router from './router'

const app = createApp(App)
const pinia = createPinia();

app.use(BootstrapIconsPlugin);
app.use(CarbonVue3);
app.use(pinia);
pinia.use(createPersistedState());

app.use(router)

app.mount('#app')
