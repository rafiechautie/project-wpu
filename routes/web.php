<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
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

Route::get('/', function () {
    /**
     * mengirimkan view home dan data title 
     */
    return view('home', [
        "title" => "Home",
        "active" => "home",
    ]);
});

Route::get('/about', function () {
    /**
     * mengirimkan view about dan data title, name, email, dan image 
     */
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Muhammad Rafie Chautie",
        "email" => "rafiqauti13@gmail.com",
        "image" => "user.jpg"
    ]);
});



Route::get('/posts', [PostController::class, 'index']);

//halaman detail post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

//halaman untuk menampilkan category yang tersedia
Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        "active" => "categories",
        'categories' => Category::all()
    ]);
});

//menampilkan daftar post yang kategorinya sama
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post by Category: $category->name",
//         "active" => "categories",
//         //load untuk menghilangkan problem N+1, saat select data post sekalian memanggil category dan author
//         'posts' => $category->posts->load('category', 'author'),
//     ]);
// });

//menampilkan halaman daftar post yang di post oleh 1 user
// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Post by Author: $author->name",
//         "active" => "posts",
//         //load untuk menghilangkan problem N+1, saat select data post sekalian memanggil category dan author
//         'posts' => $author->posts->load(['category', 'author'])
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'judul' => 'Dashboard'
    ]);
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');


Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin')->except('show');



Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);
