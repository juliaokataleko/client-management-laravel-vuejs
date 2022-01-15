require('./bootstrap');

import Clients from './components/Clients/Index'
import AddClient from './components/Clients/Form.vue'
import EditClient from './components/Clients/Form.vue'
import ShowClient from './components/Clients/Show';

window.Vue = require('vue').default;

import Vue from 'vue';

Vue.mixin({
    methods: {
        capitalizeFirstLetter: str => str.charAt(0).toUpperCase() + str.slice(1),
        currencyFormat(amount) {
            alert(amount);
        },
        formatMoney(number, decPlaces, decSep, thouSep) {
            // cart.total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&.")
            // return currencyFormatter(number, decPlaces, decSep, thouSep)
        },
    }
});


import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    {
        path: "/clients",
        name: "Clients",
        component: Clients
    },
    {
        path: "/clients/add",
        name: "AddClient",
        component: AddClient
    },
    {
        path: "/clients/:id/show",
        name: "ShowClient",
        component: ShowClient
    },
    {
        path: "/clients/:id/edit",
        name: "EditClient",
        component: EditClient
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    scrollBehavior() {
        return { x: 0, y: 0 };
    },
})

window.addEventListener('load', function () {

    let el = document.getElementById('app');
    let messages = document.getElementById('messages');

    if (el) {
        const app = new Vue({
            el: '#app',
            router: router,
            created: function () {
                this.company = "Company Name";
            }
        });
    }

})
