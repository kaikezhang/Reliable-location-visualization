<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DB;

class Solution extends Model
{
    protected $hidden = ['data', 'log'];

    protected $casts = ['data' => 'array'];

    protected $dates = [
      'created_at',
      'updated_at'
    ];

    protected $appends = 
    ['nb_nodes', 'nb_open', 'solution_time', 'obj_value',
     'parameters', 'nb_cuts', 'gap', 'problem', 
     'solver', 'status', 'log', 'has_log'];

    public function getStatusAttribute()
    {
      return array_get($this->data, 'status', '-');
    }

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

    public function getLogAttribute()
    {
      return array_get($this->data, 'log', '-');
    }

    public function getHasLogAttribute()
    {
      if($this->log == '-') 
        return false;
      return true;
    }

    private static function findAllUnique($attr){
      $ret = DB::table('solutions')
                      ->select("data->$attr AS $attr")
                      ->groupBy("data->$attr")
                      ->distinct()->get()
                      ->all();
      $ret = array_map(create_function('$o', "return trim(\$o->$attr,'\"');"), $ret);
      return $ret;  
    }

    static function getNodeses(){
      return self::findAllUnique('numberofNodes');    
    }

    static function getProblmes(){
      return self::findAllUnique('problem');    
    }

    static function getSolvers(){
      return self::findAllUnique('solver');
    }

    static function getStatuses(){
      return self::findAllUnique('status');
    }    

}
