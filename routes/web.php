<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\CategoriesController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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
    return view('front.index');
});


Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name("admin.index");
    Route::get('/profile', [AdminController::class, 'profile'])->name("admin.profile");
    Route::get('/logs', [LogViewerController::class, 'index'])->name('admin.logs');

    Route::prefix('post')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name("admin.posts.index");
        Route::get('/add', [PostsController::class, 'postAddShow'])->name("admin.posts.post-add");
        Route::post('/add', [PostsController::class, 'postAdd']);
        Route::post('/changeStatus', [PostsController::class, 'changeStatus'])->name("admin.posts.changeStatus");
        Route::post('/delete', [PostsController::class, 'delete'])->name("admin.posts.delete");
        Route::get('/update/{id}', [PostsController::class, 'updateShow'])->name("admin.posts.updateShow");
        Route::put('/update', [PostsController::class, 'update'])->name("admin.posts.update");
    });
    Route::prefix('tag')->group(function () {
        Route::get('/', [TagsController::class, 'index'])->name("admin.tags.index");
        Route::get('/add', [TagsController::class, 'tagAddShow'])->name("admin.tags.tag-add");
        Route::post('/add', [TagsController::class, 'tagAdd']);
        Route::post('/changeStatus', [TagsController::class, 'changeStatus'])->name("admin.tags.changeStatus");
        Route::post('/delete', [TagsController::class, 'delete'])->name("admin.tags.delete");
        Route::get('/update', [TagsController::class, 'updateShow'])->name("admin.tags.updateShow");
        Route::put('/update', [TagsController::class, 'update'])->name("admin.tags.update");
    });
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name("admin.categories.index");
        Route::get('/add', [CategoriesController::class, 'categoryAddShow'])->name("admin.categories.category-add");
        Route::post('/add', [CategoriesController::class, 'categoryAdd']);
        Route::post('/changeStatus', [CategoriesController::class, 'changeStatus'])->name("admin.categories.changeStatus");
        Route::post('/delete', [CategoriesController::class, 'delete'])->name("admin.categories.delete");
        Route::get('/update', [CategoriesController::class, 'updateShow'])->name("admin.categories.updateShow");
        Route::put('/update', [CategoriesController::class, 'update'])->name("admin.categories.update");
    });
});
