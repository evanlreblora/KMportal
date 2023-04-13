/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform'
import moment from "moment";
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar';
import Gate from './Gate';
import welcomehome from './components/WelcomePage.vue';
 
window.Form = Form;
Vue.prototype.$gate = new Gate(window.user);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.use(VueRouter)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))




Vue.component('welcomehome', require('./components/WelcomePage.vue'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
// define some routes
const routes = [
    { path: '/home', component:  require('./components/Dashboard.vue').default },
    { path: '/dashboard', component:  require('./components/Dashboard.vue').default },
    { path: '/profile', component:  require('./components/Profile.vue').default },
    { path: '/users', component:  require('./components/Users.vue').default },
    { path: '/annualreports', component:  require('./components/AnnualReports.vue').default },
    { path: '/policybriefs', component:  require('./components/PolicyBriefs.vue').default },
    { path: '/proceedings', component:  require('./components/Proceedings.vue').default },
    { path: '/projectcompletions', component:  require('./components/ProjectCompletions.vue').default },
    { path: '/publications', component:  require('./components/Publications.vue').default },
    { path: '/videos', component:  require('./components/Videos.vue').default },
    { path: '/abo', component:  require('./components/Abo.vue').default },
    { path: '/bimgbdocs', component:  require('./components/Bimgbdox.vue').default },
    { path: '/bimworkshopfiles', component:  require('./components/BIMWorkshopFiles.vue').default },
    { path: '/kmproducts', component:  require('./components/KMproducts.vue').default },
    { path: '/example-component', component:  require('./components/ExampleComponent.vue').default },
    { path: '/example-upload', component:  require('./components/ExampleUpload.vue').default },

    { path: '*', component:  require('./components/NotFound.vue').default },
  ]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

/* filter */
Vue.filter('capital',function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('customDate', function (data) {
    return moment(data).format('MMMM Do YYYY');
});

/* toast  */
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast = Toast;

/* vue progressbar */
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px'
  })
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


window.Fire = new Vue();
const app = new Vue({
  
    router,
    data:{
        search:""
    },

    watch: {
        search(){
            if(!this.search.length){
                window.Fire.$emit("loadUser");
            }
        }
    },

    methods: {
        getSearch: _.debounce(function () {
           if(this.search.length){
                window.Fire.$emit("search",this.search);
           }
        },800)
    },
    components: {
        'welcomehome': require('./components/WelcomePage.vue'),
    }


  }).$mount('#app')
