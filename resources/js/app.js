require('./bootstrap');

// window.Vue=require('vue')

// Vue.component('front-page',require('./components/Front.vue').default)


// const app=new Vue({
//     el:"#app"
// })

// import Vue from "vue";

window.Vue = require("vue").default;


Vue.component("front-page", require("./components/Front.vue").default);
const app = new Vue({
    el: "#app",
});