<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $hidden = ['data'];

    protected $casts = ['data' => 'array'];

    protected $dates = [
      'created_at',
      'updated_at'
    ];

    protected $appends = 
    ['nb_nodes', 'nb_open', 'solution_time', 'obj_value',
     'parameters', 'nb_cuts', 'gap', 'problem', 'solver'];

    public function getNbNodesAttribute()
    {
      return array_get($this->data, 'numberofNodes', '-');
    }

    public function getNbOpenAttribute()
    {
      return array_get($this->data, 'numberofOpen', '-');
    }

    public function getSolutionTimeAttribute()
    {
      return array_get($this->data, 'solutionTime', '-');
    }

    public function getObjValueAttribute()
    {
      return array_get($this->data, 'objectiveValue', '-');
    }   

    public function getParametersAttribute()
    {
      return array_get($this->data, 'parameters', '-');
    }

    public function getNbCutsAttribute()
    {
      return array_get($this->data, 'nbCuts', '-');
    }

    public function getGapAttribute()
    {
      return array_get($this->data, 'gap', '-');
    }

    public function getProblemAttribute()
    {
      return array_get($this->data, 'problem', '-');
    }

    public function getSolverAttribute()
    {
      return array_get($this->data, 'solver', '-');
    }
                
}
