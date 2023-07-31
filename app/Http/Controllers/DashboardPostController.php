<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view("dashboard.posts.index", [
            //cari post yang user_idnya sama dengan id user yang sedang login
            "posts" => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // ddd($request); //dump-die-debug
        // return $request->file('image')->store('post-images');

        //validasi form yang diinput user
        $validatedData = $request->validate([
            'title' => 'Required|max:255',
            'slug' => 'required|unique:posts',
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'body' => 'required'
        ]);


        //jika user ngisi gambarnya
        if ($request->file('image')) {
            //simpan gambarnya 
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        //mengambil id user yang sedang login dan menarok ke table user_id

        // $validatedData['user_id'] = auth()->user()->id;
        //mengambil kata di dalam body sebanyak 150 kata dan tarok ke variabel excerpt
        //strip_tags untuk menghilangkan tag html, defaultnya pada tix itu ada tag html ketika menuliskan value kedalamnya  
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, '...');

        // Post::create($validatedData);

        $request->user()->posts()->create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        if ($post->author->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
        $rules = [
            'title' => 'Required|max:255',
            // 'slug' => 'required|unique:posts',
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'body' => 'required'
        ];

        //kalau misalnya slug yang baru sama dengan slug yang lama maka tidak usah di validasi
        //jika slugnya diganti maka lakukan validasi
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);


        if ($request->file('image')) {
            //kalau gambar lamanya ada
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, '...');

        // Post::where('id', $post->id)->update($validatedData);
        $post->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        if ($post->image) {
            Storage::delete($post->image);
        }

        //kode untuk menghapus data post berdasarkan id
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
