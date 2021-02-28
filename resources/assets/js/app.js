require('./bootstrap');
 
import 'fullcalendar/dist/fullcalendar.css';
 
window.Vue = require('vue');
 
import FullCalendar from 'vue-full-calendar'; //Import Full-calendar
 
Vue.use(FullCalendar);
 
 
Vue.component('fullcalendar-component', require('./components/FullCalendarComponent.vue').default);
 
const app = new Vue({
    el: '#app',
});