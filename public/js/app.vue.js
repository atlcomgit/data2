new Vue({
	el: '#content_vue',
	data: {
		content_data: [],
	},
	mounted() {
		console.log(1);
		// JSON.parse(JSON.stringify({ module: "online" }))
		const data = JSON.stringify({name: "John"});
		axios({
				method: 'post', 
				url: '/api/axios',
				headers: {
					"content-type": "application/json",
				},
				data: {
					module: 'online'
				},
			})
			.then(res => {
				console.log(res.data);
				this.content_data = res.data;
			})
			.catch(err => {
				console.log(err);
			});
	},
});