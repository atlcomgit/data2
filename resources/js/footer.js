import Vue from 'vue'

//const footerVue = Vue.createApp ({}).mount('#id');
const footerVue = new Vue ({
	data() {
		return {
			id: '#footer_vue',
			count: null,
		};
	},
	mounted() {
	},
	methods: {
	},
});

export default footerVue;