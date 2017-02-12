<?php

use App\Solution;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    
    $nodeses = Solution::getNodeses();               
    $problems = Solution::getProblmes();
    $solvers = Solution::getSolvers();
    $statuses = Solution::getStatuses();                                            

    $filters = new stdClass();
    $filters->nodesOptions = array_filter(array_prepend($nodeses, 'Select Number of Nodes'));
    $filters->problemOptions = array_filter(array_prepend($problems, 'Select Problem'));
    $filters->solverOptions = array_filter(array_prepend($solvers, 'Select Solver'));
    $filters->statusOptions = array_filter(array_prepend($statuses, 'Select Status'));

    $queryBuilder = Solution::orderBy('created_at','desc');
    $shouldRecieveUpdate = true;

    if($request->has('page') && ($request->get('page') > 1)){
        $shouldRecieveUpdate = false;
    }
    if($request->has('prb')){
        $queryBuilder = $queryBuilder->where('data->problem', $request->get('prb'));
        $shouldRecieveUpdate = false;
        $filters->problem = $request->get('prb');
    } else {
        $filters->problem = 'Select Problem';
    }
    if($request->has('solver')){
        $queryBuilder = $queryBuilder->where('data->solver', $request->get('solver'));
        $shouldRecieveUpdate = false;
        $filters->solver = $request->get('solver');
    } else {
        $filters->solver = 'Select Solver';
    }
    if($request->has('status')){
        $queryBuilder = $queryBuilder->where('data->status', $request->get('status'));
        $shouldRecieveUpdate = false;
        $filters->status = $request->get('status');
    } else {
        $filters->status = 'Select Status';
    }
    if($request->has('nodes')){
        $queryBuilder = $queryBuilder->where('data->numberofNodes', intval($request->get('nodes')));
        $shouldRecieveUpdate = false;
        $filters->nodes = $request->get('nodes');
    } else {
        $filters->nodes = 'Select Number of Nodes';
    }


	$solutions = $queryBuilder->paginate(20)->appends($request->except(['page']));

    return view('index', ['solutions' => $solutions, 
                          'shouldRecieveUpdate' => $shouldRecieveUpdate,
                          'filters' => $filters]);
});

Route::get('/solutions/{id}', function ($id) {
    return view('view_solution', ['id' => $id]);
});

Route::get('/solutions/{id}/log', function ( $id) {
    $solution = Solution::findOrFail($id)->makeVisible('log');
    return view('view_log', ['solution' => $solution]);
});

Route::post('api/solutions', function(Request $request){
    $data = $request->input('data');
    $solution = new  Solution;  
    $solution->data = json_decode($data,true);
    $solution->save();
    event(new App\Events\SolutionCreated($solution));
    return response('OK id= ' .$solution->id, 200);    
});

Route::get('api/solutions/{sol}', function(Solution $sol) {
    return response()->json($sol->makeVisible('data'));
});

Route::get('heatmaps/earthquakes', function(){
	return view('heatmaps.earthquakes');
});

Route::get('heatmaps/tornadoes', function(){
	return view('heatmaps.tornadoes');
});

Route::get('heatmaps', function(){
	$maps = ['earthquakes', 'tornadoes'];
	return view('heatmaps.index', compact('maps'));
});









