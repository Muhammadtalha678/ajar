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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');
// verify otp
Route::get('/verify','App\Http\Controllers\Auth\OtpController@verify')->name('verify.show');
Route::post('/resendcode','App\Http\Controllers\Auth\OtpController@resend')->name('resendcode');
Route::post('/verify/store','App\Http\Controllers\Auth\OtpController@verifystore')->name('verifystore');
//dashboard
Route::middleware('auth','verified')->group(function(){
	Route::get('dashboard','App\Http\Controllers\HomeController@index')->name('ajarLayout.newsfeed');

	Route::get('dashboard/Non-Verify','App\Http\Controllers\HomeController@showNonVerifyPost')->name('ajarLayout.nonVerifynewsfeed');

	Route::post('create','App\Http\Controllers\HomeController@store')->name('ajarLayout.store');

// upvotevote and downvote
	Route::get('post/upvote/{post_id}','App\Http\Controllers\HomeController@upvote')->name('upvote');

	Route::get('post/downvote/{post_id}','App\Http\Controllers\HomeController@downvote')->name('downvote');

	// donate amount store
	Route::post('post/donate/{post_id}/{user_id}','App\Http\Controllers\HomeController@donate_amount')->name('donate');

	
});
Route::middleware(['auth','admin'])->group(function(){
	// Admin Work
	//home
	Route::get('admin/dashboard','App\Http\Controllers\AdminController@index')->name('admin.dashboard');
	//verifed
	Route::get('admin/posts/verifed','App\Http\Controllers\AdminController@verified')->name('admin.verified');
	//Non verifed
	Route::get('admin/posts/non-verifed','App\Http\Controllers\AdminController@nonVerified')->name('admin.nonVerified');
	// // store verification admin data
	// Route::post('admin/posts/verifed/{post_id}/{user_id}', 'App\Http\Controllers\AdminController@storenonVerified')->name('admin.verified');
	Route::post('admin/posts/verifed/{post_id}/{user_id}','App\Http\Controllers\AdminController@storenonVerified')->name('adminVerified');
});
require __DIR__.'/auth.php';
