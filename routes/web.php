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

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


Route::get('/', function () {
    return view('welcome'); //switch to tinker if you wanna run it in tinker
    //return view('tinker');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');




//Route::get('/faq', 'BotManController@show')->name('faq');



//Route::get('/public/faq', function () {
//
//return redirect('/public/faq'. '#q1');
//
//
//    //    Redirect::to(route('/public/faq') . '');
//
//
//
//});
