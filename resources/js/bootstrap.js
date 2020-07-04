window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.jQuery = window.$ = require('jquery');
window.Popper = require('popper.js');
window.swal = require('sweetalert2');
require('bootstrap');
require('./icheck');
