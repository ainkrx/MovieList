@extends('template')

@section('title', 'MovieList | Actor Details')

@section('css')
<link rel="stylesheet" href="{{ asset('css/actorDetails.css') }}">
@endsection

@section('content')
<div class="row g-3">
  <div class="col-sm-5 c_col">
    <div class="card">
        <div class="card-header d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <p class="fs-3 fw-light">Profile</p>
            </div>
    @if (Auth::check() && Auth::user()->role == 'admin')
            <a href="/actors/edit/{{$actor->id}}"><button type="button" class="btn btn-danger btn_img"><i class="fa fa-edit"></i></button></a>
            <a href="/actors/remove/{{$actor->id}}"><button type="button" class="btn btn-danger btn_img"><i class="fa fa-trash-o"></i></button></a>
        </div>
        <img src="{{Storage::url('public/'.$actor->img_url)}}" class="card-img-top img_dark" alt="...">
    @else
        </div>
        <img src="{{Storage::url('public/'.$actor->img_url)}}" class="card-img-top" alt="...">
    @endif
    </div>
    <div class="box">
        <div class="fs-3 fw-bolder">Personal Info</div>
        <div class="box">
          <p class="fw-bold">Popularity</p>
          <p class="fw-light">{{$actor->popularity}}</p>
        </div>
        <div class="box">
          <p class="fw-bold">Gender</p>
          <p class="fw-light">{{$actor->gender}}</p>
        </div>
        <div class="box">
          <p class="fw-bold">Birthday</p>
          <p class="fw-light">{{$actor->date_of_birth}}</p>
        </div>
        <div class="box">
          <p class="fw-bold">Place of Birth</p>
          <p class="fw-light">{{$actor->place_of_birth}}</p>
        </div>
    </div>
  </div>
  <div class="col">
    <div class="fs-1 fw-bolder">{{$actor->name}}</div>
      <div class="box">
        <p class="fs-5 fw-bold">Biography</p>
        <p class="fw-light text-justify">{{$actor->biography}}</p>
      </div>
      <div class="box">
        <p class="fs-5 fw-bold">Known For</p>
        <div class="row row-cols-1 row-cols-md-5 g-3">
            @forelse ($actor->movies as $m)
              <a href="/movies/view/{{$m->id}}">
                <div class="card h-100">
                  <img src="{{Storage::url('public/'.$m->img_url)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title fs-6">{{ $m->title }}</h5>
                  </div>
                </div>
              </a>
            @empty
            No movies yet.
            @endforelse
        </div>
    </div>
  </div>
</div>
@endsection
