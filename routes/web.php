<?php

use Illuminate\Support\Facades\App;
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

Route::get('/', function ()
{

    if(Auth::check())
    {
         return view('home');
    }
    return view('login');
})->name('home');

Route::name('user.')->group(function() {
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile/{id?}/{tabid?}', [\App\Http\Controllers\user\UserController::class, 'user_profile'])->name('profile');
        Route::get('/info/{id?}', [\App\Http\Controllers\user\UserController::class, 'user_info'])->name('info');
        Route::get('/users', [\App\Http\Controllers\user\UserController::class, 'all_users'])->name('users');
        Route::get('/uparametr', [\App\Http\Controllers\user\UserController::class, 'users_parametrs_update'])->name('parametrs_update');
        Route::post('/smessage/{id}', [\App\Http\Controllers\user\UserController::class, 'user_smessage'])->name('smessage');
        Route::get('/notifications/{id}', [\App\Http\Controllers\user\UserController::class, 'user_notifications'])->name('notifications');
        Route::post('/nickname/{id}', [\App\Http\Controllers\user\UserController::class, 'user_nickname'])->name('nickname');
    });

    Route::get('/login', [\App\Http\Controllers\user\UserController::class, 'user_signin'])->name('login');
    Route::post('/avatar/{id}', [\App\Http\Controllers\user\UserController::class, 'user_avatar'])->name('avatar');//Создание/изменение аватара
    Route::post('/save/{id}', [\App\Http\Controllers\user\UserController::class, 'user_save'])->name('save');//
    Route::post('/login', [\App\Http\Controllers\user\UserController::class, 'user_login']);
    Route::get('/registration', [\App\Http\Controllers\user\UserController::class, 'user_getreg'])->name('registration');
    Route::post('/registration',[\App\Http\Controllers\user\UserController::class, 'user_registration']);
    Route::get('/logout',[\App\Http\Controllers\user\UserController::class, 'user_logout'])->name('logout');



});
Route::name('group.')->group(function() {
    Route::get('group/list/{sort?}', [\App\Http\Controllers\group\GroupController::class, 'group_list'])->name('list');
    Route::get('group/info/{group?}/{text?}', [\App\Http\Controllers\group\GroupController::class, 'group_info'])->name('info');
    Route::post('group/add/', [\App\Http\Controllers\group\GroupController::class, 'group_add'])->name('add');
    Route::post('group/edit/{id?}', [\App\Http\Controllers\group\GroupController::class, 'group_edit'])->name('edit');
    Route::get('group/following/{group}', [\App\Http\Controllers\group\FollowController::class, 'following'])->name('following');
    Route::get('group/unfollowing/{group}', [\App\Http\Controllers\group\FollowController::class, 'unfollowing'])->name('unfollowing');
});

Route::name('post.')->group(function() {
    Route::post('post/create/{group}', [\App\Http\Controllers\group\PostController::class, 'post_create'])->name('create');
    Route::get('post/reputation/{post}/{value}', [\App\Http\Controllers\group\PostController::class, 'post_reputation'])->name('reputation');
    Route::get('post/reputation/{post}', [\App\Http\Controllers\group\PostController::class, 'post_delete'])->name('delete');
});

Route::view('/credits','credits')->name('credits');
Route::view('/about','about')->name('about');


