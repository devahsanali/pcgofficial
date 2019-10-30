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

/*Route::get('/', function () {
    return view('auth.login');
});*/

Route::get('/table', function () {
    return view('admin.table');
});
Route::get('/form', function () {
    return view('admin.form');
});
Route::get('/welcome', 'HomeController@index')->name('home');

//social auth
//Route::get('login/google', 'Social\GoogleController@redirectToProvider')->name('google.login');
//Route::get('auth/google/callback', 'Social\GoogleController@handleProviderCallback');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/', 'Admin\TournamentController@index')->name('admin.home');

Auth::routes(['verify' => true]);
//Auth::routes();
Route::group(['middleware' => ['role:admin', 'auth'], 'prefix' => 'admin'], function () {
	//Auth
	Route::post('/register', 'Admin\Auth\RegisterController@register')->name('admin.post.register');
	Route::get('register', 'Admin\Auth\RegisterController@admin_register')->name('admin.register');

	//Dashboard
	Route::get('/', 'Admin\TournamentController@index')->name('admin.home');
	Route::get('/dashboard', 'Admin\TournamentController@index')->name('admin.home');
	//Route::post('role/create', 'Admin\RoleController@create_role')->name('role.create');

	//Tornament
	Route::get('tournament/manage', 'Admin\TournamentController@index')->name('admin.tournament.manage');
	Route::get('tournament/manage/{id}', 'Admin\TournamentController@details')->name('admin.tournament.details');
	Route::get('tournament/add', 'Admin\TournamentController@add')->name('admin.tournament.add');
	Route::post('tournament/post', 'Admin\TournamentController@post')->name('admin.tournament.post');
	Route::get('tournament/edit/{id}', 'Admin\TournamentController@edit')->name('admin.tournament.edit');
	Route::post('tournament/update/', 'Admin\TournamentController@update')->name('admin.tournament.update');
    Route::post('tournament/delete', 'Admin\TournamentController@delete')->name('admin.tournament.delete');
    Route::post('tournament/status', 'Admin\TournamentController@status')->name('admin.tournament.status');
	Route::post('tournament/upload/image', 'Admin\TournamentController@imageUpload')->name('admin.tournament.upload.image');
    Route::get('tournament/remove/image', 'Admin\TournamentController@removeImage')->name('admin.tournament.remove.image');
    //schedule
    Route::get('tournament/schedule/{id}', 'Admin\ScheduleController@index')->name('admin.tournament.schedule');
    Route::get('tournament/schedule/delete/{id}', 'Admin\ScheduleController@delete')->name('admin.tournament.schedule.delete');

    //search 
    Route::get('search', 'Admin\SearchController@search')->name('admin.search');


    
});

Route::group(['middleware' => ['role:player']], function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');
});
