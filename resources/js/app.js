
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';
import MainApp from './components/MainApp.vue'
import {initialize} from './helpers/general';

Vue.use(VueRouter);
Vue.use(Vuex);

const store= new Vuex.Store(StoreData);

const router =new VueRouter({

routes,
mode:'history',
// mounted: function() {
//     if(this.$route.query.code)
//     {q = this.$route.query.q;
//     console.log(q)}
// },

});



// axios.defaults.headers.common['Content-Type'] = 'application/json';
// axios.defaults.headers.common['Access-Control-Allow-Credentials'] = 'true';
// axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
// axios.defaults.headers.common['Access-Control-Allow-Methods'] = 'GET, POST, PATCH, DELETE, PUT, OPTIONS';
// axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'Origin, Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With';
// axios.defaults.withCredentials = true;
//axios.defaults.headers.common['Access-Control-Allow-Headers'] = '*';
//axios.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'

initialize(store, router);


const app = new Vue({
    el: '#app',
    router,
    store,
    components:{
        MainApp
    }
});
