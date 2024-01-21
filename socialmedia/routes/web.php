<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Strona główna (dostępna dla wszystkich)
Route::view('/', 'welcome')->name('welcome');

// Strona logowania
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register-modal', [AuthController::class, 'registerModal'])->name('register.modal');


//strona główna z postami
Route::get('posts', [PostController::class, 'index'])->name('user.posts');

// Strona użytkownika
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Strona użytkownika z postami
    Route::get('/user/posts/liked', [PostController::class, 'indexForLikedByUser'])->name('user.postsLiked');
    Route::get('/user/posts/created', [PostController::class, 'indexForCurrentUser'])->name('user.posts');
    Route::post('/user/posts', [PostController::class, 'store'])->name('user.posts.store');
    Route::get('/user/posts/create', [PostController::class, 'create'])->name('user.posts.create');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/dislike', [PostController::class, 'dislike'])->name('posts.dislike');

    // Strona czatu
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/users', [ChatController::class, 'getUsers'])->name('chat.users');
});

// Strona administracyjna (dostępna tylko dla administratorów)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Grupa tras dla administratora
    Route::middleware(['auth', 'admin'])->group(function () {
        // Trasy związane z zarządzaniem użytkownikami
        Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::post('/admin/users/{user}/block', [AdminController::class, 'blockUser'])->name('admin.users.block');
        Route::post('/admin/users/{user}/unblock', [AdminController::class, 'unblockUser'])->name('admin.users.unblock');

        // Trasy związane z zarządzaniem postami przez administratora
        Route::prefix('admin/posts')->group(function () {
            Route::get('', [AdminPostController::class, 'managePosts'])->name('admin.posts');
            Route::get('/{post}/edit', [AdminPostController::class, 'editPost'])->name('admin.posts.edit');
            Route::put('/{post}', [AdminPostController::class, 'updatePost'])->name('admin.posts.update');
            Route::get('/{post}/confirm-delete', [AdminPostController::class, 'confirmDeletePost'])->name('admin.posts.confirmDelete');
            Route::delete('/{post}', [AdminPostController::class, 'deletePost'])->name('admin.posts.delete');
        });
    });
});
