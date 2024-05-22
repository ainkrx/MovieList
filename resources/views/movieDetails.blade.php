@extends('template')

@section('css')
<link rel="stylesheet" href="{{ asset('css/movieDetails.css') }}">
@endsection

@if($movie == null)
@section('title', 'Movie not found')
@else
@section('title', 'MovieList | '.$movie->title)
@endif

@section('content')
@if($movie == null)
<div class="container-fluid" style="height: 50vh;">
    <h4>Oops, looks like we don't have that movie yet!</h4>
</div>
@else
<div class="banner">
    <img src="{{ Storage::url($movie->img_url) }}" alt="" class="background-img">
    <div class="gradient-block"></div>
    <div class="details d-flex flex-row justify-content-around align-items-center flex-wrap">
        <img class="card-img" src="{{ Storage::url($movie->img_url) }}" alt="">
        <div class="col-6 text-start">
            <p class="h1">{{ $movie->title }}</p>
            <div class="flex-row my-4">
                @foreach($movie->genres as $genre)
                <span class="genre">{{ $genre->genre }}</span>
                @endforeach
            </div>
            <p class="fs-6 m-0">Release Year</p>
            <p class="fw-bold fs-5">{{ $movie->getReleaseYear() }}</p>
            <p class="h5">Storyline</p>
            <p class="fs-6">{{ $movie->description }}</p>
            <p class="h5">{{ $movie->director }}</p>
            <p class="fs-6">Director</p>
            @auth
            <div>
                @if(Auth::user()->role == "member" && !Auth::user()->inUserWatchlist($movie->id))
                Add to watchlist <a style="color: white" href="/watchlists/add/{{ $movie->id }}"><i class="bi bi-plus-lg"></i></a>
                @elseif(Auth::user()->role == "member" && Auth::user()->inUserWatchlist($movie->id))
                Added to watchlist <a style="color: red;" href="/watchlists/remove/{{ $movie->id }}"><i class="bi bi-check-lg"></i></a>
                @elseif(Auth::user()->role == "admin")
                <a href="/movies/edit/{{ $movie->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </a>
                <a href="/movies/remove/{{ $movie->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                    </svg>
                </a>
                @endif
            </div>
            @endauth
        </div>
    </div>
</div>
<div class="container-fluid mx-5 my-3">
    <div class="text-start h4 section-title c">
        Cast
    </div>
    <div class="row row-cols-1 row-cols-md-5 g-3">
        @forelse ($movie->actors as $a)
        <div class="col">
            <a href="/actors/view/{{$a->id}}">
                <div class="card h-100">
                    <img class="actor-img" src="{{Storage::url('public/'.$a->img_url)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$a->name}}</h5>
                        <p class="card-text">
                            {{substr($a->movies[0]->title, 0, 35)}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        No actors available.
        @endforelse
    </div>
    <div class="text-start h4 section-title py-2 my-3">
        More
    </div>
    <div class="container-fluid my-3">
        <div class="row row-cols-1 row-cols-md-5 g-3">
            @foreach ($more as $m)
            <div class="card">
                <img src="{{ Storage::url($m->img_url) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/movies/view/{{ $m->id }}" class="movie-link">
                        <h5 class="card-title fs-6">{{ $m->title }}</h5>
                    </a>
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        <p class="card-text fs-6">{{ $m->getReleaseYear() }}</p>
                        @auth
                        @if(Auth::user()->role == "member" && !Auth::user()->inUserWatchlist($m->id))
                        <a style="color: white" href="/watchlist/add/{{ $m->id }}"><i class="bi bi-plus-lg"></i></a>
                        @elseif(Auth::user()->role == "member" && Auth::user()->inUserWatchlist($m->id))
                        <a style="color: red;" href="/watchlist/remove/{{ $m->id }}"><i class="bi bi-check-lg"></i></a>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
