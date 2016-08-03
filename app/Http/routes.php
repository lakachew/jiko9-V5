<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * API
 */
Route::group(['prefix' => 'api/v4' ], function()
{
    Route::post('authenticate', 'Auth\JWTController@authenticate');
    //Route::post('authenticate/user', 'Auth\JWTController@getAuthenticatedUser');
    Route::post('authenticate/user/works', 'Auth\JWTController@getUserWorks');
    Route::post('authenticate/user/worklog', 'Auth\JWTController@getStartedWorklogByUserWorkId');
    Route::post('authenticate/user/worklog/start', 'Auth\JWTController@setStartedMap');
    Route::post('authenticate/user/worklog/stop', 'Auth\JWTController@setStopedMap');

});

Route::get('/', function () {
    
    if(Auth::check())
    {
        return redirect('work/unfinished');
    }

    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/contact', 'EmployeeController@contact');



/**
 * USER_WORK ROUTES
 */

Route::get('work/assign', 'UserWorkController@getAssignForm');
Route::post('work/assign', 'UserWorkController@assign');


/**
 * WORK ROUTES
 */
Route::get('work/all', 'WorkController@getAll');
Route::get('work/unfinished', 'WorkController@getUnfinished');
Route::get('work/finished', 'WorkController@getFinished');
Route::get('work/form', 'WorkController@getWorkForm');
Route::post('work/register', 'WorkController@addNew');

Route::get('work/{idValue}', 'WorkController@getById');


/**
 * EMPLOYEE ROUTES
 */
Route::get('employee/all', 'EmployeeController@getAll'); //DONE
Route::get('employee/active', 'EmployeeController@getActive');
Route::get('employee/inactive', 'EmployeeController@getInactive');
Route::get('employee/assigned', 'EmployeeController@getAssigned'); //DONE NEEDS TO ILIMINATE THE ADMIN AND OFFICE WORKERS FROM DATABASE
Route::get('employee/not_assigned', 'EmployeeController@getNotAssigned'); //DONE NEEDS TO ILIMINATE THE ADMIN AND OFFICE WORKERS FROM DATABASE

Route::get('employee/{idValue}', 'EmployeeController@getById');





/**
 * CUSTOMER ROUTES
 */
Route::get('customer/form', 'CustomerController@getCustomerForm');
Route::post('customer/register', 'CustomerController@addNew');
Route::get('customer/all', 'CustomerController@showAll');

/*Route::resource('customers', 'CustomerController', [
    'only' => [
        'index', 'store'
    ]
]);*/





