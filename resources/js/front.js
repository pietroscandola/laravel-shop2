

import App from './components/App';
window.Vue = require('vue');

const app = new Vue({
    el: '#root',
    render: h => h(App),
});