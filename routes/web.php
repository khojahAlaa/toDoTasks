<?php
//to test the relation between models
use App\User;
use App\Department;
use App\MyTask;



Route::get('todomytask', function () {
    // $user= Project::all()->where('manager_id',  1);
   

    // return  $user;
    $user= auth()->user()->id;
        $myToDoTasks= MyTask::where('user_id',$user)->where('is_done',0)->get();
        dd($myToDoTasks);
});

Route::get('/inProgressTask', function(){
    // $taskUser =Task_user::findOrFail(11);
    $recoed= Task_user::where('task_id', 9)->where('user_id', 9)->first();
     $recoed->update([ 'status_id' => 2]);
    dd($recoed);
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('h', function () {
    return view('home');
});




Auth::routes();


//----------------------------------------------------------------------------------//

Route::middleware(['admain'])->group(function(){
    Route::get('users', 'UserController@filterUsers')->name('filter-users');
    Route::get('manager', 'UserController@manager'); //dropdown select for manager
    // Route::get('team', 'UserController@taskTeam'); //dropdown select for assign task to mulite user
    Route::post('users', 'UserController@store')->name('save-user');
    Route::delete('users/{id}', 'UserController@destroy')->name('del-user');
    Route::post('users/{id}', 'UserController@update')->name('update-user');
});

//----------------------------------------------------------------------------------//

Route::get('team', 'UserController@taskTeam');
Route::get('profile/{id}', 'UserController@showProfile')->name('show-user-profile');
Route::post('profile/{id}', 'UserController@updateProfile')->name('update-user-profile');
Route::post('userimg/{id}', 'UserController@userPhoto')->name('user-photo');

//----------------------------------------------------------------------------------//


Route::get('myCreatedTasks', 'MyTaskController@index');
Route::get('/myCreatedTasks/{id}', 'MyTaskController@show')->name('myCreatedTask.show');
Route::post('myCreatedTasks', 'MyTaskController@store')->name('save.myCreatedTask');
Route::post('/myCreatedTasks/{id}', 'MyTaskController@update')->name('update.myCreatedTask');
Route::delete('/myCreatedTasks/{id}', 'MyTaskController@destroy')->name('delete.myCreatedTask');
Route::patch('/myCreatedTasks/{taskId}', 'MyTaskController@isDone')->name('isDone.myCreatedTask');


//----------------------------------------------------------------------------------//
Route::get('UserDashboard', 'DashboardController@userDashboard');
//----------------------------------------------------------------------------------//
Route::get('Dashboard', 'DashboardController@managerDashboard');
Route::get('managerDashboard', 'DashboardController@managerDashboard');
Route::get('eDashboard', 'DashboardController@executiveDashboard');
Route::get('usersRelatedToDep', 'DashboardController@usersRelatedToDep');
Route::get('managersRelatedToDep', 'DashboardController@managersRelatedToDep');
Route::get('projectsRelatedToManager/{classify}', 'DashboardController@projectsClassify');
Route::get('belongToDep/{Classify}/{depIDClassify}', 'DashboardController@belongToDepClassify');

//----------------------------------------------------------------------------------//

Route::get('/home', 'HomeController@index')->name('home');
Route::get('{path}','HomeController@index')->where( 'path', '([A-z\/_.\d-]+)?' );

//----------------------------------------------------------------------------------//


 

