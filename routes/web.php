<?php
use App\Http\Controllers\IndexController;

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

Route::get('/home', 'IndexController@index');

Route::post('/home', 'IndexController@post');

// Route::post('/home', function() {
//     if(Input::get('create_post')) {
//         return 'IndexController@create_post';
//     }
//     elseif(Input::get('delete_post')) {
//         return 'IndexController@delete_post';
//     }

//     header('Location: /home');
//     exit;
// });

// Route::post('/home', 'indexController@delete');


// Route::get('/', 'IndexController@show');
Route::get('/home/detail/{id}', 'IndexController@detail')->name('detail');

Auth::routes();

Route::get('/home', 'HomeController@index');
