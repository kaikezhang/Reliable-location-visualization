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

    $problems = DB::table('solutions')->select('data->problem AS problem')
                            ->groupBy('data->problem')
                            ->distinct()->get()
                            ->all();
    $problems = array_map(create_function('$o', 'return trim($o->problem,\'\"\');'), $problems);                        

    $solvers = DB::table('solutions')->select('data->solver AS solver')
                            ->groupBy('data->solver')
                            ->distinct()->get()->all();
    $solvers = array_map(create_function('$o', 'return trim($o->solver,\'\"\');'), $solvers);
    

    $statuses = DB::table('solutions')->select('data->status AS status')
                            ->groupBy('data->status')
                            ->distinct()->get()->all();
    $statuses = array_map(create_function('$o', 'return trim($o->status,\'\"\');'), $statuses);                                            

    $filters = new stdClass();
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









