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

Auth::routes();

Route::get('/', 'IndexController@index');

// Route::post('/', 'IndexController@post');

Route::post('/', function() {
    dd('through');
    if(Input::get('create')) {
        return 'IndexController@create';
    }
    elseif(Input::get('delete')) {
        return 'IndexController@delete';
    }

    header('Location: /');
    exit;
});

Route::post('/', 'indexController@delete');


// Route::get('/', 'IndexController@show');
Route::get('/detail/{id}', 'IndexController@detail')->name('detail');

Route::get('/ajaxdetail/{id}', 'IndexController@ajaxdetail')->name('detail');
