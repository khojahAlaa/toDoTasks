import Vue from "vue";
import VueRouter from 'vue-router';
Vue.use(VueRouter)

// import Profile from './pages/Profile.vue'

let routes = [
    { path: '/profile', component: require('./pages/Profile.vue').default },
    { path: '/userdashbord', component: require('./pages/dashbords/UserDashboard.vue').default },
    { path: '/assignedTasks', component: require('./pages/task/AssignedTasks.vue').default },
    { path: '/MyTasks', component: require('./pages/task/MyTasks.vue').default },

    
    { path: '/managerdashboard', component: require('./pages/dashbords/ManagerDashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default }
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

  
  export default router;
