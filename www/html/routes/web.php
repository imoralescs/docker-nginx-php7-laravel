<?php

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
// Import Model
use App\Task;

// Object Request
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

// Task App Route
Route::get('/task', function(){
  $tasks = Task::orderBy('created_at', 'asc')->get();

  return view('tasks.index',[
    'tasks' => $tasks,
  ]);
});

Route::post('/task', function(Request $request){
  // Debugging return purpose
  // return 'Works';

  // Debugging return $request
  // dd($request);

  // Validation
  $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
  ]);

  if($validator->fails()){
    return redirect('/task')
      ->withInput()
      ->withErrors($validator);
  }

  // After validation, create Task

  // Method 1 - And more common method.
  // $task = new Task;
  // $task->name = $request->name;
  // $task->save();


  // Method 2 - In this case we need to add fillable element on Model
  Task::create([
    'name' => $request->name,
  ]);

  // Redirect to main page
  return redirect('/task');
});

Route::delete('/task/{task}', function(Task $task){
  // Debugging return
  // return 'Works';

  $task->delete();
  return redirect('/task');
});
