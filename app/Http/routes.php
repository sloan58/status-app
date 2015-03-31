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

/*
 * Route Model Binding
 */
Route::model('statuses', 'App\Status');
Route::model('projects', 'App\Project');

/*
 *  Project Routes
 */
Route::get('projects/mine', 'ProjectsController@mine');
Route::resource('projects', 'ProjectsController');

/*
 * Nested Statuses Routes
 */
Route::resource('projects.statuses', 'StatusesController');

/*
 * Get all Statuses
 */
Route::get('/statuses/all', [
    'as' => 'statuses.all',
    'uses' => 'StatusesController@all'
]);

/*
 * The home page
 * Displays all projects for the authenticated User
 */
Route::get('/', [
    'as' => 'home',
    'uses' =>'ProjectsController@mine'
]);

Route::pattern('id', '[0-9]+');
Route::get('news/{id}', 'NewsController@show');
Route::get('video/{id}', 'VideoController@show');
Route::get('photo/{id}', 'PhotoController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

if (Request::is('admin/*'))
{
    require __DIR__.'/admin_routes.php';
}

Route::group([ 'prefix' => 'reports'], function(){

    Route::get('projects','ReportsController@projects');

});