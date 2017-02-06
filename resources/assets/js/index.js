import Echo from "laravel-echo";
import Vue from "vue";

import DashTable from './components/DashTable.vue';

const tableVue = new Vue({
	el: '#dash-table-container',
  components: {
   DashTable
  },
});


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6a4043788c762cfe9306'
});

window.Echo.channel('solutions')
    .listen('SolutionCreated', (solution) => {
   solutions.unshift(solution);
});

