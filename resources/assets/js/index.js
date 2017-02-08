import Echo from "laravel-echo";
import Vue from "vue";

import DashTable from './components/DashTable.vue';
import FilterForm from './components/FilterForm.vue';

const tableVue = new Vue({
	el: '#app',
  components: {
   DashTable,
   FilterForm
  },
});

if(shouldRecieveUpdate){
  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6a4043788c762cfe9306'
  });

  window.Echo.channel('solutions')
    .listen('SolutionCreated', (solution) => {
    solutions.unshift(solution);
  });  
}


