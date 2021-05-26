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

Route::get('/', function () {
    return view('welcome');
});

Route::get('phpinfo', function () {
    ob_start();
    phpinfo();
    return ob_get_clean();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('/admin/users', \App\Http\Controllers\AdminUsersController::class);
    Route::resource('/items', \App\Http\Controllers\ItemController::class);

    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
    Route::post('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{post}/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    Route::delete('/posts/{post}/thumbnail', [\App\Http\Controllers\PostController::class, 'deleteThumbnail'])
        ->name('posts.delete-thumbnail');
    Route::resource('/posts', App\Http\Controllers\PostController::class)->except('show');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
    Route::delete('/profile/delete-avatar', [App\Http\Controllers\ProfileController::class, 'deleteAvatar'])->name('profile.delete-avatar');
});