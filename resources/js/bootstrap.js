window._ = require('lodash');



try {
  //  window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');





window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "73af0a7e3573ca356c40",
    cluster: "ap2",
   // encrypted: true,
    forceTLS: true,
    auth: {
      headers: {
        //'Accept':'application/json',
        //'Content-Type':'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + window.localStorage.getItem("jwtToken")
      },
  },
});
