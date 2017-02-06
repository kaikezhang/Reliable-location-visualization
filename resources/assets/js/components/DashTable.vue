<template>

  <table class="table is-striped" id="solutionsTable">
    <thead>
      <tr>
        <th>ID</abbr></th>
        <th>#Nodes</th>
        <th>Parameters</th>
        <th>#Open</th>
        <th>ObjValue</th>
        <th>Gap(%)</th>
        <th>Time</th>
        <th>#Cuts</th>
        <th>Problem</th>
        <th>Solver</th>
        <th>Solved at</th>
        <th></th>
      </tr>
    </thead>
    
    <tbody name="tr-trasition" is="transition-group">
      <tr v-for="solution in solutions" :key="solution.id">
        <td> {{solution.id}}</td>
        <td> {{solution.nb_nodes}}</td>
        <td> <pre>{{solution.parameters}}</pre></td>
        <td> {{solution.nb_open}}</td>
        <td> {{solution.obj_value | toLocal}}</td>
        <td> {{solution.gap | toTwoDecimal}}</td>
        <td> {{solution.solution_time | toTwoDecimal | toLocal}}</td>
        <td> {{solution.nb_cuts}}</td>
        <td> {{solution.problem}}</td>
        <td> {{solution.solver}}</td>
        <td> {{solution.created_at}} </td>
        <td><a :href="'/solutions/' + solution.id">View</a></td>
      </tr>   
    </tbody>
    
  </table>


   
</template>

<script>
export default {
  name: 'dash-table',
  data(){
    return {
      'solutions' : solutions,
    };
  },
  filters: {
    toTwoDecimal(value){
      if(isNaN(value))
        return value;        
      else
        return value.toFixed(2);
    },
    toLocal(value){
      if(isNaN(value))
        return value;        
      else
        return value.toLocaleString();
    }
  }
}
</script>

<style>
.tr-trasition-enter-active, .tr-trasition-leave-active {
  transition: all 0.5s;
}
.tr-trasition-enter, .tr-trasition-leave-to  {
  opacity: 0;
  transform: translateY(10px);
}
.tr-trasition-move {
  transition: transform 0.5s;
}    
</style>
