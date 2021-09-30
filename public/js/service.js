/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/service.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// https://jsfiddle.net/
var Service = /*#__PURE__*/function () {
  function Service() {
    var _this = this;

    _classCallCheck(this, Service);

    this.is_windowFocused = true;
    this.is_mouseOver = false;
    this.is_documentActive = true, this._timeouts = {}, this._configs = {
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
    window.addEventListener('blur', function () {
      _this.is_windowFocused = false;

      _this.setDocumentActive();
    });
    window.addEventListener('focus', function () {
      _this.is_windowFocused = true;

      _this.setDocumentActive();
    });
    document.addEventListener('mouseleave', function () {
      _this.is_mouseOver = false;

      _this.setDocumentActive();
    });
    document.addEventListener('mouseenter', function () {
      _this.is_mouseOver = true;

      _this.setDocumentActive();
    });
  }

  _createClass(Service, [{
    key: "setDocumentActive",
    value: function setDocumentActive() {
      this.is_documentActive = this.is_windowFocused || this.is_mouseOver;
    } // ________________________________________________________________________________________________________________________________________

  }, {
    key: "log",
    value: function log(logStr) {
      if (this._configs.is_versionDebug) console.log('v' + this._configs.version + ': ' + logStr);
    } // ________________________________________________________________________________________________________________________________________

  }, {
    key: "stopTimeout",
    value: function stopTimeout(timeout_id) {
      if (timeout_id in this._timeouts) {
        clearTimeout(this._timeouts[timeout_id]);
        delete this._timeouts[timeout_id];
      }
    }
  }, {
    key: "startedTimeout",
    value: function startedTimeout(timeout_id) {
      return this._timeouts[timeout_id] !== undefined && this._timeouts[timeout_id] > 0;
    }
  }, {
    key: "startTimeout",
    value: function startTimeout(timeout_id, func, timer) {
      this.stopTimeout(timeout_id);
      if (timer > 0) this._timeouts[timeout_id] = setTimeout(func, timer);
    } // ________________________________________________________________________________________________________________________________________

  }, {
    key: "int_ending",
    value: function int_ending(number, _endings, add_number) {
      add_number = add_number === false ? false : true;
      number = number.toString().split('.').shift();
      var minus = ~number.indexOf('-'),
          plus = ~number.indexOf('+');
      number = number.replace(/[^0-9]/g, '');
      var bb = parseInt(number.toString().substring(number.length - 2, number.length)),
          aa = bb % 10,
          ending;
      if (aa == 1 && aa != 11) ending = _endings[1] || '';else if (aa > 1 && aa < 5 && !(bb > 11 && bb < 15)) ending = _endings[2] || '';else ending = _endings[0] || '';
      return (add_number ? (minus ? '-' : plus ? '+' : '') + number + ' ' : '') + ending;
    }
  }, {
    key: "format_phone",
    value: function format_phone(phone, add_plus, add_space) {
      add_plus = add_plus === undefined ? ~phone.indexOf('+') ? '+' : '' : add_plus === true ? '+' : add_plus;
      add_space = add_space === undefined ? '' : add_space === true ? ' ' : add_space;
      phone = phone.replace(/\D/g, '');
      return phone.split('').reverse().join('').replace(/(\d{1,4})(\d{1,3})(\d{1,3})?(\d{1,2})?/g, function (txt, d, c, b, a) {
        a = a.split('').reverse().join('');
        if (a && phone.length == 11 && a == '8') a = '7';
        b = b.split('').reverse().join('');
        c = c.split('').reverse().join('');
        d = d.split('').reverse().join('');
        if (d && d.length == 4) d = d.substring(0, 2) + add_space + '-' + add_space + d.substring(2, 4);
        if (d) return add_plus + a + add_space + ' (' + b + ') ' + c + add_space + '-' + add_space + d;else if (c) return add_plus + a + add_space + ' (' + b + ') ' + c + add_space + '-' + add_space + d;else if (b) return add_plus + a + add_space + ' (' + b + ') ' + c;else if (a) return add_plus + a + add_space + ' (' + b + ') ';
      });
    }
  }, {
    key: "seconds_toArray",
    value: function seconds_toArray(seconds) {
      var _result = [],
          count_zero = false,
          periods = [60, 3600, 86400, 31536000];
      seconds = parseInt(seconds);

      for (var i = 3; i >= 0; i--) {
        var period = Math.floor(seconds / periods[i]);

        if (period > 0 || period == 0 && count_zero) {
          _result[i + 1] = period;
          seconds -= period * periods[i];
          count_zero = true;
        }
      }

      _result[0] = seconds;
      return _result;
    }
  }, {
    key: "seconds_toString",
    value: function seconds_toString(seconds, zero_add, time_names) {
      var result = '';
      if (zero_add === undefined) zero_add = true;
      if (time_names === undefined) time_names = [' сек', ' мин', ' час', ' дн', ' лет'];

      var _timerArray = this.seconds_toArray(seconds);

      for (var i = _timerArray.length - 1; i >= 0; i--) {
        if ((zero_add || _timerArray[i] > 0) && time_names[i] != '') result += _timerArray[i] + time_names[i] + " ";
      }

      return result.trim();
    } // ________________________________________________________________________________________________________________________________________

  }, {
    key: "reverse_date",
    value: function reverse_date(datetime, reverse, date_separator, time_separator) {
      reverse = reverse === undefined ? true : reverse;
      date_separator = date_separator === undefined ? '.' : date_separator;
      time_separator = time_separator === undefined ? ':' : time_separator;

      if (datetime !== undefined && datetime.length >= 10) {
        var dt = datetime.split(' '),
            dd = dt[0] || '',
            tt = dt[1] || '';

        if (~dd.indexOf('.') || ~dd.indexOf('-')) {
          var sp = dd.replaceAll('-', '.').split('.');
          datetime = (reverse ? parseInt(sp[0]) > 1900 ? sp[0] + date_separator + sp[1] + date_separator + sp[2] : sp[2] + date_separator + sp[1] + date_separator + sp[0] : parseInt(sp[0]) > 1900 ? sp[2] + date_separator + sp[1] + date_separator + sp[0] : sp[0] + date_separator + sp[1] + date_separator + sp[2]) + (tt != '' ? ' ' + tt.replaceAll(':', time_separator).replaceAll('.', time_separator) : '');
        }
      }

      return datetime;
    }
  }, {
    key: "today_toString",
    value: function today_toString(reverse) {
      return this.date_toString('now', reverse);
    }
  }, {
    key: "date_toString",
    value: function date_toString(date, reverse) {
      if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = new Date();else if (!(date instanceof Date)) date = new Date(date);
      reverse = reverse === undefined ? true : reverse;
      return reverse ? String(date.getFullYear()) + '.' + ('0' + String(date.getMonth() + 1)).slice(-2) + '.' + ('0' + String(date.getDate())).slice(-2) : ('0' + String(date.getDate())).slice(-2) + '.' + ('0' + String(date.getMonth() + 1)).slice(-2) + '.' + String(date.getFullYear());
    }
  }, {
    key: "time_toString",
    value: function time_toString(date) {
      if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = new Date();else if (!(date instanceof Date)) date = new Date(date);
      return ('0' + String(date.getHours())).slice(-2) + ':' + ('0' + String(date.getMinutes())).slice(-2) + ':' + ('0' + String(date.getSeconds())).slice(-2);
    } // date_incDays(date, days) {
    // 	if (days === undefined) days = 0;
    // 	if (date === undefined || date === 0 || date === '' || date == 'now' || date == 'date' || date == 'time') date = this.today_toString();
    // ...
    // }

  }, {
    key: "differDates_toSeconds",
    value: function differDates_toSeconds(dateStart, dateEnd) {
      return Math.floor((new Date(this.reverse_date(dateEnd)).getTime() - new Date(this.reverse_date(dateStart)).getTime()) / 1000);
    }
  }, {
    key: "differDates_toDays",
    value: function differDates_toDays(dateStart, dateEnd) {
      return Math.floor((new Date(this.reverse_date(dateEnd)).getTime() - new Date(this.reverse_date(dateStart)).getTime()) / 1000 / 86400);
    } // ________________________________________________________________________________________________________________________________________

  }]);

  return Service;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (new Service());
/******/ })()
;