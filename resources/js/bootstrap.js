window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const JwtToken = `Bearer ${localStorage.getItem('token')}`;
window.axios.defaults.headers.common['Authorization'] = JwtToken;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

//For Pusher 
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "d3814f92001113e357bb",
    cluster: "ap2",
    forceTLS: true,
    encrypted: true,
    auth:{
        headers:{
            Authorization: JwtToken
        }
    }
});






//For laravel web sockets 
// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     authEndpoint : 'http://127.0.0.1:8000/broadcasting/auth',
//     broadcaster: 'pusher',
//     key: "myKey",
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
//     auth:{
//         headers:{
//             Authorization: JwtToken
//         }
//     }
// });
