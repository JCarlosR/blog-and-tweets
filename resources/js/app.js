require('./bootstrap');

window.Vue = require('vue');

Vue.component('tweets-component',
    require('./components/TweetsComponent.vue').default
);

const app = new Vue({
    el: '#app'
});
