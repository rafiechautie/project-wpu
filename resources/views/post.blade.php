{{-- fitur untuk melihat isi value blog_posts yang dikirim di route posts dan memberhentikan code di bawahnya --}}
{{-- @dd($post); --}}

{{-- halaman ini mengambil main layout --}}
@extends('layout.main')

@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <article>
                <h2>{{ $post->title }}</h2>
                <h5>By: <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a></h5>
                
                @if ($post->image)
                <div style="max-height: 350px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}"
                    class="img-fluid">
                @endif

                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
            </article>
        
            <a href="/posts">Back to Posts</a>
        </div>
    </div>
</div>

    
@endsection