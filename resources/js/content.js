import Vue from 'vue'
import srv from './service'
import footerVue from './footer'
import vModal from './vues/v-modal'

const contentVue = new Vue ({
	components: {
		vModal
	},
	data() {
		return {
			id: '#content_vue',
			module_name: module_name,

			content_starting: true,
			content_getting: true,
			content_data: [],

			modal_sid: "",
			modal_data: null,

			today: srv.today_toString(),
		};
	},
	mounted() {
		srv.log('vue start [module - '+this.module_name+']');
		this.content_starting = false;
		this.moduleTableUpdate_setTimeout(srv._timers.delay_documentStartWait);
		let vues = document.getElementsByClassName('vue');
		for (let i = 0; i < vues.length; i++) vues[i].style.visibility = 'visible';
	},
	methods: {
		content_getting_set(value) {
			this.content_getting = value;
		},

		moduleTableUpdate_setTimeout(timer) {
			srv.startTimeout('timeout_update_', this.moduleTableUpdate, timer);
		},
		moduleTableUpdate() {
			if (!srv.is_documentActive) return this.moduleTableUpdate_setTimeout(srv._timers.delay_documentActiveWait);
			this.moduleTableGetDataAll();
		},
		moduleTableGetDataAll() {
			axios({
					method: 'post', 
					url: srv._configs.api_urlAxios,
					headers: { "content-type": "application/json" },
					data: { module: this.module_name },
				})
				.then(res => {
					this.moduleTableUpdate_setTimeout(srv._timers.delay_documentRefreshWait);
					if (res.data.status) this.content_data = res.data.module_data;
					footerVue.count = this.content_data.length;
					this.content_getting = false;
				})
				.catch(err => {
					srv.log(err);
					this.moduleTableUpdate_setTimeout(srv._timers.delay_documentErrorWait);
					this.content_getting = false;
				});
		},

		moduleShowModal(event) {
			let sid = $(event.target).closest('tr').attr('sid') ?? "";
			// console.log(sid);
			if (this.modal_sid == sid) this.moduleTableGetData(sid);
			this.modal_sid = sid;
		},
		moduleTableGetData(sid) {
			this.modal_data = null;
			axios({
					method: 'post', 
					url: srv._configs.api_urlAxios,
					headers: { "content-type": "application/json" },
					data: { module: this.module_name, sid: sid },
				})
				.then(res => {
					if (res.data.status) this.modal_data = res.data.module_data;
					(new bootstrap.Modal(document.getElementById('staticBackdrop'),{})).show();
					})
				.catch(err => {
					srv.log(err);
					(new bootstrap.Modal(document.getElementById('staticBackdrop'),{})).show();
				});
		},

		column_data(column) {
			switch (column) {
				case 'olnDate':			return srv.reverse_date(this.modal_data[column],false);
				case 'olnTermTo':		return 'до '+srv.reverse_date(this.modal_data[column],false);
				case 'olnTermDays':
					let days = srv.differDates_toDays(srv.today_toString(),this.modal_data.olnTermTo,false);
					return ((days > 0) ? '+' : '') + srv.int_ending(days,['дней','день','дня'],true);
				case 'olnUserPhone':	return srv.format_phone("+"+this.modal_data[column]);
				case 'olnCheckDT':		return srv.seconds_toString(srv.differDates_toSeconds(this.modal_data.olnDate+' '+this.modal_data.olnTime,this.modal_data[column]),true);
				case 'olnPageUrl':		return this.modal_data[column].replace('/db/search','');

				default: return this.modal_data[column];
			}
		},
		column_class(column) {
			switch (column) {
				case 'olnTermDays':
					let days = srv.differDates_toDays(srv.today_toString(),this.modal_data.olnTermTo,false);
					return (days < 0) ? 'text-danger' : 'text-success';

				default: return '';
			}
		},
		is_operator() {
			return (~['11111111','22222222','33333333'].indexOf(this.modal_data.olnUserCode)) ? true : false;
		},
	},
})

export default contentVue;