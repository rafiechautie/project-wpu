<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //debug untuk menangkap value yang dikirim pada form search
        // dd(request('search'));

        //menangkap data post yang berurutan dari yang paling terbaru
        $posts = Post::latest();

        //jika ada value search yang dikirimkan
        // if (request('search')) {
        //     //cari post yang value searchnya sama dengan yang ada di judul atau body
        //     $posts->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        $title = '';
        if (request('category')) {
            //cari kategori yang slugnya sama dengan yang ada di value request category
            $category = Category::FirstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            //cari author yang usernamenya sama dengan yang ada di value request username
            $author = User::FirstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }


        return view('posts', [
            "title" => "All Posts" . $title,
            "active" => "posts",
            //menampilkan seluruh data post
            // "posts" => Post::all()
            //menampilkan seluruh data post yang terbaru 
            //with digunakan untuk menghidari N+1 problem, saat ambil data posts, sekalian lansung ambil data author dan category    
            "posts" => $posts->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }

    //controller untuk menampilkan detail post
    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "active" => "posts",
            "post" => $post
        ]);
    }
}
