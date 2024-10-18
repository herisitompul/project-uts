<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

//====================// Untuk Admin //====================//
Route::middleware(['auth'])->group(function () {
    Route::get('/homeadmin', [MenuController::class, 'adminhome'])->name('admin-home');
    Route::delete('/admin-delete-post/{post}', [MenuController::class, 'adminDeletePost'])->name('admin-delete-post');
    Route::delete('/admin-delete-comment/{comment}', [MenuController::class, 'adminDeleteComment'])->name('admin-delete-comment');
});

//====================// Untuk Admin //====================//

// Rute untuk halaman home
Route::get('/home', [MenuController::class, 'home'])
    ->name('home')
    ->middleware('auth');

// Rute untuk halaman profile
Route::get('/profile', [MenuController::class, 'profile'])
    ->name('profile')
    ->middleware('auth');

Route::get('/search', [MenuController::class, 'search'])->name('search')->middleware('auth');

// Rute untuk halaman edit profile
Route::get('/edit-profile', [MenuController::class, 'edit_profile'])
    ->name('edit-profile')
    ->middleware('auth');

// Rute untuk menyimpan perubahan pada halaman edit profile
Route::post('/update-profile', [MenuController::class, 'updateProfile'])
    ->name('update-profile')
    ->middleware('auth');

Route::get('/user-profile/{id}', [MenuController::class, 'show'])
    ->name('user-profile');

//====================// Untuk Community //====================//
Route::get('/community', [MenuController::class, 'community'])->name('community.index');

//====================// Untuk Isi Community //====================//
Route::get('network_engineer', [MenuController::class, 'network_engineer'])->name('network_engineer');
Route::get('database_administrator', [MenuController::class, 'database_administrator'])->name('database_administrator');
Route::get('frontend', [MenuController::class, 'frontend'])->name('frontend');
Route::get('data_analyst', [MenuController::class, 'data_analyst'])->name('data_analyst');
Route::get('backend', [MenuController::class, 'backend'])->name('backend');
Route::get('web_developer', [MenuController::class, 'web_developer'])->name('web_developer');
//====================// Untuk Community //====================//

//====================// Untuk Settings //====================//
Route::get('/settings', [MenuController::class, 'settings'])->name('settings');
Route::post('/update-email', [MenuController::class, 'updateEmail'])->name('update-email');
Route::post('/update-password', [MenuController::class, 'updatePassword'])->name('update-password');
//====================// Untuk Settings //====================//


// Rute untuk menampilkan halaman pembuatan post baru
Route::get('/create-post', [PostController::class, 'create'])
    ->name('create-post')
    ->middleware('auth');

// Rute untuk menyimpan post baru
Route::post('/store-post', [PostController::class, 'store'])
    ->name('store-post')
    ->middleware('auth');



Route::post('/post-like/{id}', [PostController::class, 'like'])->name('post-like');
Route::post('/post-comment/{id}', [PostController::class, 'comment'])->name('post-comment');
Route::post('/like-post/{post}', [PostController::class, 'likePost'])->name('like-post');
Route::post('/comment-post/{post}', [PostController::class, 'commentPost'])->name('comment-post');

// Rute untuk mengedit post
Route::get('/edit-post/{post}', [PostController::class, 'editPost'])->name('edit-post');
Route::put('/update-post/{post}', [PostController::class, 'updatePost'])->name('update-post');

// Rute untuk menghapus post
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('delete-post');

Route::get('/edit-post/{post}', [PostController::class, 'editPost'])->name('edit-post');

Route::delete('/delete-comment/{comment}', [PostController::class, 'deleteComment'])->name('delete-comment');

// Rute otentikasi (login, register, dll.)
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/contactus', function () {
    return view('contactus');
})->name('contactus');