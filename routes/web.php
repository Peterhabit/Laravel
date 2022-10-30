<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GubunController;

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

Route::get('/', function () {
    return view('main');
});

// Route::controller(ProductController::class)->group(function(){
	// //Route::get('member', [MemberController::class, 'index'] );
	// Route::get('member', 'index')->name('member.index'); <-appends함수로 전달
// });

Route::resource('member', MemberController::class);
Route::resource('gubun', GubunController::class);


Route::resource('product', ProductController::class);