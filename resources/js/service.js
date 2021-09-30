// https://jsfiddle.net/

class Service {

	constructor() {
		this.is_windowFocused = true;
		this.is_mouseOver = false;
		this.is_documentActive = true,
			this._timeouts = {},
			this._configs = {
				version: 1.00,
				is_versionDebug: true,
				api_urlAxios: '/api/axios'
			};
		this._timers = {
			delay_documentStartWait: 500,
			delay_documentActiveWait: 1000,
			delay_documentRefreshWait: 60000,
			delay_documentErrorWait: 5000
		};
		window.addEventListener('blur', () => { this.is_windowFocused = false; this.setDocumentActive(); });
		window.addEventListener('focus', () => { this.is_windowFocused = true; this.setDocumentActive(); });
		document.addEventListener('mouseleave', () => { this.is_mouseOver = false; this.setDocumentActive(); });
		document.addEventListener('mouseenter', () => { this.is_mouseOver = true; this.setDocumentActive(); });
	}

	setDocumentActive() { this.is_documentActive = (this.is_windowFocused || this.is_mouseOver); }

	// ________________________________________________________________________________________________________________________________________

	log(logStr) { if (this._configs.is_versionDebug) console.log('v' + this._configs.version + ': ' + logStr); }

	// ________________________________________________________________________________________________________________________________________

	stopTimeout(timeout_id) {
		if (timeout_id in this._timeouts) { clearTimeout(this._timeouts[timeout_id]); delete this._timeouts[timeout_id]; }
	}

	startedTimeout(timeout_id) {
		return (this._timeouts[timeout_id] !== undefined && this._timeouts[timeout_id] > 0);
	}

	startTimeout(timeout_id, func, timer) {
		this.stopTimeout(timeout_id); if (timer > 0) this._timeouts[timeout_id] = setTimeout(func, timer);
	}

	// ________________________________________________________________________________________________________________________________________

	int_ending(number, _endings, add_number) {
		add_number = (add_number === false) ? false : true;
		number = number.toString().split('.').shift();
		let minus = (~number.indexOf('-')), plus = (~number.indexOf('+'));
		number = number.replace(/[^0-9]/g, '');
		let bb = parseInt(number.toString().substring(number.length - 2, number.length)), aa = bb % 10, ending;
		if (aa == 1 && aa != 11) ending = _endings[1] || ''; else if (aa > 1 && aa < 5 && !(bb > 11 && bb < 15)) ending = _endings[2] || ''; else ending = _endings[0] || '';
		return (add_number ? ((minus ? '-' : (plus ? '+' : '')) + number + ' ') : '') + ending;
	}

	format_phone(phone, add_plus, add_space) {
		add_plus = (add_plus === undefined) ? (~phone.indexOf('+') ? '+' : '') : ((add_plus === true) ? '+' : add_plus);
		add_space = (add_space === undefined) ? '' : ((add_space === true) ? ' ' : add_space);
		phone = phone.replace(/\D/g, '');
		return phone
			.split('').reverse().join('')
			.replace(/(\d{1,4})(\d{1,3})(\d{1,3})?(\d{1,2})?/g, function (txt, d, c, b, a) {
				a = a.split('').reverse().join(''); if (a && phone.length == 11 && a == '8') a = '7';
				b = b.split('').reverse().join('');
				c = c.split('').reverse().join('');
				d = d.split('').reverse().join(''); if (d && d.length == 4) d = d.substring(0, 2) + add_space + '-' + add_space + d.substring(2, 4);
				if (d) return add_plus + a + add_space + ' (' + b + ') ' + c + add_space + '-' + add_space + d;
				else if (c) return add_plus + a + add_space + ' (' + b + ') ' + c + add_space + '-' + add_space + d;
				else if (b) return add_plus + a + add_space + ' (' + b + ') ' + c;
				else if (a) return add_plus + a + add_space + ' (' + b + ') ';
			});
	}

	seconds_toArray(seconds) {
		let _result = [], count_zero = false, periods = [60, 3600, 86400, 31536000];
		seconds = parseInt(seconds);

		for (let i = 3; i >= 0; i--) {
			let period = Math.floor(seconds / periods[i]);
			if ((period > 0) || (period == 0 && count_zero)) {
				_result[i + 1] = period;
				seconds -= period * periods[i];
				count_zero = true;
			}
		}
		_result[0] = seconds;
		return _result;
	}

	seconds_toString(seconds, zero_add, time_names) {
		let result = '';
		if (zero_add === undefined) zero_add = true;
		if (time_names === undefined) time_names = [' сек', ' мин', ' час', ' дн', ' лет'];
		let _timerArray = this.seconds_toArray(seconds);
		for (let i = _timerArray.length - 1; i >= 0; i--) if ((zero_add || _timerArray[i] > 0) && time_names[i] != '') result += _timerArray[i] + time_names[i] + " ";
		return result.trim();
	}

	// ________________________________________________________________________________________________________________________________________

	reverse_date(datetime, reverse, date_separator, time_separator) {
		reverse = (reverse === undefined) ? true : reverse;
		date_separator = (date_separator === undefined) ? '.' : date_separator;
		time_separator = (time_separator === undefined) ? ':' : time_separator;

		if (datetime !== undefined && datetime.length >= 10) {
			let dt = datetime.split(' '), dd = dt[0] || '', tt = dt[1] || '';
			if (~dd.indexOf('.') || ~dd.indexOf('-')) {
				let sp = dd.replaceAll('-', '.').split('.');
				datetime = (
					(reverse)
						? ((parseInt(sp[0]) > 1900) ? sp[0] + date_separator + sp[1] + date_separator + sp[2] : sp[2] + date_separator + sp[1] + date_separator + sp[0])
						: ((parseInt(sp[0]) > 1900) ? sp[2] + date_separator + sp[1] + date_separator + sp[0] : sp[0] + date_separator + sp[1] + date_separator + sp[2])
				) + ((tt != '') ? ' ' + tt.replaceAll(':', time_separator).replaceAll('.', time_separator) : '');
			}
		}
		return datetime;
	}

	today_toString(reverse) {
		return this.date_toString('now', reverse);
	}

	date_toString(date, reverse) {
		if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = new Date();
			else if (!(date instanceof Date)) date = new Date(date);
		reverse = (reverse === undefined) ? true : reverse;
		return (reverse)
			? String(date.getFullYear()) + '.' + ('0' + String(date.getMonth()+1)).slice(-2) + '.' + ('0' + String(date.getDate())).slice(-2)
			: ('0' + String(date.getDate())).slice(-2) + '.' + ('0' + String(date.getMonth()+1)).slice(-2) + '.' + String(date.getFullYear());
	}
	time_toString(date) {
		if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = new Date();
			else if (!(date instanceof Date)) date = new Date(date);
		return ('0' + String(date.getHours())).slice(-2) + ':' + ('0' + String(date.getMinutes())).slice(-2) + ':' + ('0' + String(date.getSeconds())).slice(-2);
	}

	// date_incDays(date, days) {
	// 	if (days === undefined) days = 0;
	// 	if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = this.today_toString();
	// ...
	// }

	differDates_toSeconds(dateStart, dateEnd) {
		return Math.floor((new Date(this.reverse_date(dateEnd)).getTime() - new Date(this.reverse_date(dateStart)).getTime()) / 1000);
	}

	differDates_toDays(dateStart, dateEnd) {
		return Math.floor((new Date(this.reverse_date(dateEnd)).getTime() - new Date(this.reverse_date(dateStart)).getTime()) / 1000 / 86400);
	}

	// ________________________________________________________________________________________________________________________________________
}

export default new Service();