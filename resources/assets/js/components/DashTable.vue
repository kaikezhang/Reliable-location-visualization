<template>
<div>
  <table v-if="solutions.length > 0" class="table is-striped" id="solutionsTable">
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
        <th>Status</th>
        <th>Log</th>
        <th>Map</th>
      </tr>
    </thead>
    
    <tbody name="tr-trasition" is="transition-group">
      <tr v-for="solution in solutions" :key="solution.id">
        <td> <a :href="'/solutions/' + solution.id ">{{solution.id}}</a> </td>
        <td> {{solution.nb_nodes}}</td>
        <td> <pre>{{solution.parameters}}</pre></td>
        <td> {{solution.nb_open}}</td>
        <td> {{solution.obj_value | toLocal}}</td>
        <td> {{solution.gap | toTwoDecimal}}</td>
        <td> {{solution.solution_time | toTwoDecimal | toLocal}}</td>
        <td> {{solution.nb_cuts}}</td>
        <td> {{solution.problem}}</td>
        <td> {{solution.solver}}</td>
        <td>
        <span :class="{ 'is-danger': solution.status === 'Error',
                        'is-warning': solution.status === 'Infeasible' 
                                      || solution.status === 'Time Reached',
                        'is-success': solution.status === 'Gap Reached',
                        }" class="tag is-medium" > 
              {{solution.status}} 
        </span>       
        </td>
        <td>
        <template v-if="solution.has_log">
          <a :href="'/solutions/' + solution.id + '/log'">Check</a>
        </template>          
        </td>  
        <td>
        <template v-if="isHasSolution(solution)">
        <a :href="'/solutions/' + solution.id + '/map'">View</a>
        </template>
        </td>
      </tr>   
    </tbody> 
  </table>
  <h2 v-else class="subtitle is-2 has-text-centered">No solution yet!</h4>
</div>


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
  },
  methods:{
    isInfeasible(solution){
      return solution.status === "Infeasible";
    },
    isHasSolution(solution){
      return solution.status != "Infeasible" && solution.status != "Error";
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
