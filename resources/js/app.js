require('./bootstrap');
import { createApp } from 'vue';
import mainapp from './components/mainapp.vue';
import router from './router';
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'
import { Axios } from "axios";
import common from './common';
import translate from './VueTranslation/Translation';

let app=createApp({})
app.component('mainapp' , mainapp);
app.component('translate', translate);
app.mixin(common)

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$translate = translate.translate;

// app.component('common' , common);

app.use(router).use(ViewUIPlus).mount("#app")
