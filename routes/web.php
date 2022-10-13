<?php

use Illuminate\Support\Facades\Route;
// use app\Http\Controllers\PagesController;


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
// use App\Http\Controllers\PagesController; Already configured in Route service provider


Route::get('/test', 'PagesController@test');
Route::get('/', 'PagesController@welcome');
Route::get('/logout', 'PagesController@logout');
Route::get('/myaccount', 'PagesController@myaccount');

Route::get('/{pagename}', 'PagesController@manager');
Route::get('/eventdetail/{code}', 'PagesController@eventdetails');




//Api Routes

Route::post('/api/{class_name}/{func_name}', 'ApiController@manager');
