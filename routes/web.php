<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//需要前往路由的服务提供者类中设置命名空间
Route::get('/', 'PagesController@root')->name('root');

//不需要
//Route::get('/', [\App\Http\Controllers\PagesController::class, 'root'])->name('root');