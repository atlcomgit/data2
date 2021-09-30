import Vue from 'vue'
import footerVue from './footer'
import contentVue from './content'
// import devtools from '@vue/devtools'

Vue.config.productionTip = false;
Vue.config.devtools = false;

footerVue.$mount('#footer_vue');
contentVue.$mount('#content_vue');
	