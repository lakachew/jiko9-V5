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

Route::get('/', function () {
    
    if(Auth::check())
    {
        return redirect('work/unfinished');
    }

    return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');

/**
 * WORK ROUTES
 */
Route::get('work/all', 'WorkController@getAll');
Route::get('work/unfinished', 'WorkController@getUnfinished');
Route::get('work/finished', 'WorkController@getFinished');
Route::get('work/form', 'WorkController@getWorkForm');
Route::post('work/register', 'WorkController@addNew');


/**
 * EMPLOYEE ROUTES
 */
Route::get('employee/all', 'EmployeeController@getAll'); //DONE
Route::get('employee/active', 'EmployeeController@getActive');
Route::get('employee/inactive', 'EmployeeController@getInactive');
Route::get('employee/assigned', 'EmployeeController@getAssigned'); //DONE NEEDS TO ILIMINATE THE ADMIN AND OFFICE WORKERS FROM DATABASE
Route::get('employee/not_assigned', 'EmployeeController@getNotAssigned'); //DONE NEEDS TO ILIMINATE THE ADMIN AND OFFICE WORKERS FROM DATABASE


/**
 * CUSTOMER ROUTES
 */
Route::get('customer/form', 'CustomerController@getCustomerForm');
Route::post('customer/register', 'CustomerController@addNew');
Route::get('customer/all', 'CustomerController@showAll');

/**
 * USER_WORK ROUTES
 */

Route::get('work/assign', 'UserWorkController@getAssignForm');
Route::post('work/assign', 'UserWorkController@assign');




