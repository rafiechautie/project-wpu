{{-- fitur untuk melihat isi value blog_posts yang dikirim di route posts dan memberhentikan code di bawahnya --}}
{{-- @dd($posts); --}}

{{-- halaman ini mengambil main layout --}}
@extends('layout.main')

@section('container')
<h1 class="text-center mb-3">{{ $title }}</h1>


<div class="row justify-content-center mb-3">
  <div class="col-md-6">
    <form action="/posts" method="GET">
      @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
      @endif
      @if (request('author'))
          <input type="hidden" name="author" value="{{ request('author') }}">
      @endif
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>


{{-- jika ada data di dalam variable posts maka berikan value true --}}
@if ($posts->count())
<div class="card mb-3">

  @if ($posts[0]->image)
	<div style="max-height: 350px; overflow: hidden;">
		<img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">
	</div>
	@else
	<img src="https://source.unsplash.com/1200x400/?{{ $posts[0]->category->name }}" class="card-img-top"
		alt="{{ $posts[0]->category->name }}">
	@endif
    
    <div class="card-body text-center">
        {{-- diambil indeks ke 0 karena saat di controller kita udah otomatis memanggil berdasarkan data yang terbaru --}}
      <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
      <p>
        <small class="text-muted">
            By: <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none text-dark">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
        </small>
      </p>

      <p class="card-text">{{ $posts[0]->excerpt }}</p>
      <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary">Read more</a>
    </div>
  </div>
    



<div class="container">
    <div class="row">
        {{-- menampilkan seluruh data di dalam posts kecuali data yang indeksnya 0 --}}
        @foreach ($posts->skip(1) as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="position-absolute bg-dark px-3 py-2 text-white " style="background-color: rgba(0, 0, 0, 0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">{{ $post->category->name }}</a></div>

                @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" alt="{{ $post->category->name }}"
                  class="img-fluid">
                @endif
                
                <div class="card-body">
                  <h5 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
                  <p>
                    <small class="text-muted">
                        By: <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none text-dark">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                    </small>
                  </p>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

@else
    <p class="text-center fs-4">No post Found</p>
@endif

<div class="d-flex justify-content-center" >
  {{ $posts->links() }}
</div>

@endsection
    
