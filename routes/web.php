<?php

use App\Http\Controllers\admin\IpController;
use App\Http\Controllers\Album\AlbumController;
use App\Http\Controllers\Album\AlbumUnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\MessagesController;
use App\Http\Controllers\group\GroupController;
use App\Http\Controllers\group\FollowController;
use App\Http\Controllers\post\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\DefaultTab;
use App\Http\Controllers\BlogController;
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
Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::middleware(['access'])->group(function () {//access
            Route::prefix('dashboard')->group(function () {
                Route::get('/connects/{ip?}/{show?}/{sort?}/{method?}', [DashboardController::class, 'connects'])->name('connects');
                Route::get('/community/{tabid?}/{sort?}/{view?}', [DashboardController::class, 'community'])->name('community');
                Route::get('/groups/{sort?}/{view?}', [DashboardController::class, 'groups'])->name('groups');
                Route::get('/user/{user}', [DashboardController::class, 'userEdit'])->name('useredit');
                Route::get('/user/block/{id}', [DashboardController::class, 'user_block'])->name('userblock');
                Route::get('/user/muted/{id}', [DashboardController::class, 'user_muted'])->name('usermuted');
                Route::get('/user/hidden/{id}', [DashboardController::class, 'user_hidden'])->name('userhidden');
                Route::get('/group/visibility/{id}', [DashboardController::class, 'groupVisibility'])->name('visibility');
                Route::get('/group/open/{id}', [DashboardController::class, 'groupOpen'])->name('open');
                Route::resource('ip',IpController::class)->only(['update', 'destroy']);
            });
        });
    });
});
Route::name('tab.')->group(function () {
    Route::prefix('tab')->group(function () {
        Route::get('/index/{tabid?}', [DefaultTab::class, 'index'])->name('index');
        Route::get('/create/{value}/{titel}/{type}/{route}', [DefaultTab::class, 'create'])->name('create');
        Route::get('/close/{tabid}', [DefaultTab::class, 'close'])->name('close');
    });
});
Route::middleware(['connect'])->group(function () {

    Route::get('/', [HomeController::class,'index'])->name('home');
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
            Route::get('info/{group?}', [GroupController::class, 'group_info'])->name('info');
            Route::middleware(['auth'])->group(function () {
                Route::post('add/', [GroupController::class, 'group_add'])->name('add');
                Route::post('edit/{id?}', [GroupController::class, 'group_edit'])->name('edit');
                Route::post('avatar/{id}', [GroupController::class, 'group_avatar'])->name('avatar');
                Route::get('following/{group}', [FollowController::class, 'following'])->name('following');
                Route::get('unfollowing/{group}', [FollowController::class, 'unfollowing'])->name('unfollowing');
            });
        });
    });
    Route::middleware(['auth'])->group(function () {
        Route::resource('album.unit',AlbumUnitController::class);
        Route::resource('album',AlbumController::class);
    });
    Route::prefix('post')->group(function () {
        Route::name('post.')->group(function () {
            Route::middleware(['auth'])->group(function () {
                Route::post('create/{group}', [PostController::class, 'create'])->name('create');
                Route::get('reputation/{post}/{value}', [PostController::class, 'post_reputation'])->name('reputation');
                Route::get('delete/{post}', [PostController::class, 'post_delete'])->name('delete');
                Route::get('quote/{text}', [PostController::class, 'post_quote'])->name('quote');
            });
        });
    });
    Route::middleware(['auth'])->group(function () {
        Route::resource('blog',BlogController::class);
    });
});
    Route::view('/credits', 'credits')->name('credits');
    Route::view('/about', 'about')->name('about');


