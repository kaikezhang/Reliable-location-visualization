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

Route::get('/', function () {
	$solutions = Solution::orderBy('created_at','desc')->paginate(20);

    return view('index', ['solutions' => $solutions]);
});

Route::get('/solutions/{id}', function ($id) {
    return view('view_solution', ['id' => $id]);
});

Route::post('api/solutions', function(Request $request){
    $data = $request->input('data');
    $solution = new  Solution;  
    $solution->data = json_decode($data,true);
    $solution->save();
    event(new App\Events\SolutionCreated($solution));
    return response('OK id=' .$solution->id, 200);    
});

Route::get('api/solutions/{sol}', function(Solution $sol) {

    return response()->json($sol);
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









