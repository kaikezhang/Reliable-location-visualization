<template>
<div>
<div class="column is-12">
<div class="columns">
  <div class="column">
    <span class="control select is-medium">
      <select v-model="nodes">
        <option v-for="option in nodesOptions" v-bind:value="option">
          {{ option }}
        </option>
      </select>
    </span>    
  </div> 
  <div class="column">
      <span class="control select is-medium">
        <select v-model="problem">
          <option v-for="option in problemOptions" v-bind:value="option">
            {{ option }}
          </option>
        </select>
      </span>
  </div>
  <div class="column">
      <span class="control select is-medium">
        <select v-model="solver">
          <option v-for="option in solverOptions" v-bind:value="option">
            {{ option }}
          </option>
        </select>
      </span>
  </div>
  <div class="column">
      <span class="control select is-medium">
        <select v-model="status">
          <option v-for="option in statusOptions" v-bind:value="option">
            {{ option }}
          </option>
        </select>
      </span>
  </div>        
</div>
</div>
<div class="column is-12">
  <div class="control is-pulled-right">
      <span class="control" @click.prevent="submit">
        <button class="button is-primary is-medium">Submit</button>
      </span>
      <span class="control" @click.prevent="reset">
        <button class="button is-medium">Reset</button>
      </span>     
  </div> 
</div>     
</div>
</template>

<script>
export default {
  name: 'filter-form',
  data(){
    return filters;
  },
  methods: {
    encodeQueryData(data) {
       let ret = [];
       for (let d in data)
         ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
       return ret.join('&');
    },
    reset(){
      this.nodes = this.nodesOptions[0];
      this.problem = this.problemOptions[0];
      this.solver = this.solverOptions[0];
      this.status = this.statusOptions[0];
    }, 
    submit(){
      let paras = {};
      if( ! this.nodes.includes('Select') ){
        paras.nodes = this.nodes;
      }      
      if( ! this.problem.includes('Select') ){
        paras.prb = this.problem;
      }
      if( ! this.solver.includes('Select') ){
        paras.solver = this.solver;
      }
      if( ! this.status.includes('Select') ){
        paras.status = this.status;
      }
      let querystring = this.encodeQueryData(paras);
      if(Object.keys(paras).length > 0){
        window.location.href = '/?' + querystring;
      } else {
        window.location.href = '/';
      }          
    },
  }
}
</script>

