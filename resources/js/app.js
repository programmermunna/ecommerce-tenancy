import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './Router/tenant';

const app = createApp(App)
app.use(router)
app.mount('#content')
