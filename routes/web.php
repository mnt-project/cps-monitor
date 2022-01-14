<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\MessagesController;
use App\Http\Controllers\group\GroupController;
use App\Http\Controllers\group\FollowController;
use App\Http\Controllers\group\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
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

Route::get('/', [HomeController::class,'index'])->name('home');

Route::middleware(['connect'])->group(function () {
    Route::name('user.')->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::get('/profile/{id?}/{tabid?}', [UserController::class, 'user_profile'])->name('profile');
            Route::get('/users', [UserController::class, 'all_users'])->name('users');
            Route::get('/uparametr', [UserController::class, 'users_parametrs_update'])->name('parametrs_update');
            Route::post('/smessage/{id}', [UserController::class, 'user_smessage'])->name('smessage');
            Route::get('/notifications/{id}', [UserController::class, 'user_notifications'])->name('notifications');
            Route::get('/hidden/{id}', [UserController::class, 'user_hidden'])->name('hidden');
            Route::post('/nickname/{id}', [UserController::class, 'user_nickname'])->name('nickname');
            Route::post('/password/{id}', [UserController::class, 'user_password'])->name('password');
            Route::post('/about/{id}', [UserController::class, 'user_about'])->name('about');
            Route::get('/reputationup/{id}', [UserController::class, 'user_reputationup'])->name('reputationup');
            Route::get('/reputationdown/{id}', [UserController::class, 'user_reputationdown'])->name('reputationdown');
            Route::get('/logout', [UserController::class, 'user_logout'])->name('logout');
            Route::name('message.')->group(function () {
                Route::post('/send/{id}', [MessagesController::class, 'message_send'])->name('send');
                Route::get('/delete/{id}', [MessagesController::class, 'message_delete'])->name('delete');
            });
        });
        Route::get('/info/{id?}', [UserController::class, 'user_info'])->name('info');
        Route::get('/login', [UserController::class, 'user_signin'])->name('login');
        Route::post('/avatar/{id}', [UserController::class, 'user_avatar'])->name('avatar');//Создание/изменение аватара
        //Route::post('/save/{id}', [UserController::class, 'user_save'])->name('save');
        Route::post('/login', [UserController::class, 'user_login']);
        Route::get('/registration', [UserController::class, 'user_getreg'])->name('registration');
        Route::post('/registration', [UserController::class, 'user_registration']);
    });
    Route::name('group.')->group(function () {
        Route::prefix('group')->group(function () {
            Route::get('list/{sort?}', [GroupController::class, 'group_list'])->name('list');
            Route::get('info/{group?}/{text?}', [GroupController::class, 'group_info'])->name('info');
            Route::middleware(['auth'])->group(function () {
                Route::post('add/', [GroupController::class, 'group_add'])->name('add');
                Route::post('edit/{id?}', [GroupController::class, 'group_edit'])->name('edit');
                Route::post('avatar/{id}', [GroupController::class, 'group_avatar'])->name('avatar');
                Route::get('following/{group}', [FollowController::class, 'following'])->name('following');
                Route::get('unfollowing/{group}', [FollowController::class, 'unfollowing'])->name('unfollowing');
            });
        });
    });
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::middleware(['access'])->group(function () {//access
                Route::prefix('dashboard')->group(function () {
                    Route::get('/connections/{sort?}/{method?}/{show?}/{connect?}', [DashboardController::class, 'connections'])->name('connections');
                    Route::post('/address/add/{id}', [DashboardController::class, 'address_add'])->name('addressadd');
                    Route::get('/address/{id}', [DashboardController::class, 'address_info'])->name('addressinfo');
                    Route::get('/community/{sort?}/{view?}', [DashboardController::class, 'community'])->name('community');
                    Route::get('/groups/{sort?}/{view?}', [DashboardController::class, 'groups'])->name('groups');
                    Route::get('/user/{user}', [DashboardController::class, 'userEdit'])->name('useredit');
                    Route::get('/group/visibility/{id}', [DashboardController::class, 'groupVisibility'])->name('visibility');
                    Route::get('/group/open/{id}', [DashboardController::class, 'groupOpen'])->name('open');
                });
            });
        });
    });
    Route::name('post.')->group(function () {
        Route::post('post/create/{group}', [PostController::class, 'post_create'])->name('create');
        Route::get('post/reputation/{post}/{value}', [PostController::class, 'post_reputation'])->name('reputation');
        Route::get('post/reputation/{post}', [PostController::class, 'post_delete'])->name('delete');
    });

    Route::view('/credits', 'credits')->name('credits');
    Route::view('/about', 'about')->name('about');
});


