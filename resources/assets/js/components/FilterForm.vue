<template>
<div class="control" >
    <span class="control select is-medium">
      <select v-model="problem">
        <option v-for="option in problemOptions" v-bind:value="option">
          {{ option }}
        </option>
      </select>
    </span>

    <span class="control select is-medium">
      <select v-model="solver">
        <option v-for="option in solverOptions" v-bind:value="option">
          {{ option }}
        </option>
      </select>
    </span>

    <span class="control select is-medium">
      <select v-model="status">
        <option v-for="option in statusOptions" v-bind:value="option">
          {{ option }}
        </option>
      </select>
    </span>
    <span class="control" @click.prevent="submit">
      <button class="button is-primary is-medium">Submit</button>
    </span>  
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
    submit(event){
      let paras = {};
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

