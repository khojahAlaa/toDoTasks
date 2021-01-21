// import Popper from 'popper.js';
// Popper.Defaults.modifiers.computeStyle.gpuAcceleration = false;
// require('popper.js');
require('./bootstrap');

window.Vue = require('vue')
import Vue from 'vue'
import router from "./router";
import VCalendar from 'v-calendar';

import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';

import DateFilter from '././filters/datefilter';
import StrLimit from '././filters/strLimit';
import Authorization from './authorization/authorize';
//to make it accecable in all vue component
Vue.use(Authorization);
// import VeeValidate from "vee-validate";
// Vue.use(VeeValidate);

Vue.filter('dateFormat',DateFilter );
Vue.filter('strLimit',StrLimit );

Vue.use(VueIziToast);



window.fire = new Vue();
// source: https://vcalendar.io/custom-defaults.html
Vue.use(VCalendar, {
    componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
  });


Vue.component('pm-profile', require('./pages/Profile.vue').default)
Vue.component('pm-other-profile', require('./pages/OtherProfile.vue').default)
Vue.component('pm-welcome', require('././components/welcomeComp.vue').default)
Vue.component('my-created-tasks', require('./pages/task/MyTasks.vue').default)
Vue.component('assigned-tasks', require('./pages/task/AssignedTasks.vue').default)
Vue.component('pm-user-dashboard', require('./pages/dashbords/UserDashboard.vue').default)

Vue.component('pm-manager-dashboard', require('./pages/dashbords/ManagerDashboard.vue').default)
Vue.component('my-projects-page', require('./pages/project/MyProjectsPage.vue').default)
Vue.component('projects-detail', require('./pages/project/ProjectDetail.vue').default)

const app = new Vue({
    router,
    el: '#app',
    
});


