@extends('template')

@section('title', 'MovieList | Update Profile')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/updateProfile.css') }}">
@endsection

@section('content')
<div class="row g-3">
  <div class="col-sm-5 c_col">
    <div class="card">
        <br>
        <div class="card-header">
            <p class="fs-3 fw-bold">My <span class='red-text'>Profile</span></p>
        </div>
        <a class="profile" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <img src="{{$user->img_url}}" class="card-img-top mx-auto" alt="...">
        </a>
        <p class="fw-bold">{{$user->name}}</p>
        <p class="fw-light">{{$user->email}}</p>
    </div>
  </div>
  <div class="col">
    @if ($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    <div class="fs-3 fw-bolder red-text">Update Profile</div> <br>
    <form action="/profile/editData" method="post" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="input-group mb-3">
            <label for="name" class="input-group-text c_form-label">Username</label>
            <input type="text" class="form-control c_form-input" placeholder="{{$user->name}}" id="name" name="name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label for="email" class="input-group-text c_form-label">Email</label>
            <input type="text" class="form-control c_form-input" placeholder="{{$user->email}}" id="email" name="email" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <label for="dob" class="input-group-text c_form-label">DOB</label>
            <input type="date" class="form-control c_form-input" placeholder="{{$user->date_of_birth}}" id="dob" name="dob" aria-describedby="basic-addon1">            </div>
        <div class="input-group mb-3">
            <label for="phone" class="input-group-text c_form-label">Phone</label>
            <input type="text" class="form-control c_form-input" placeholder="{{$user->phone}}" id="phone" name="phone" aria-describedby="basic-addon1">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary c_btn" type="submit" name="btn-submit" value="submit"> Save Changes </button>
        </div>
    </form>
  </div>
</div>
{{-- update img modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        @if ($errors->any())
        <h4>{{$errors->first()}}</h4>
        @endif
        <form action="/profile/editImage" method="post" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control c_form-input" placeholder="Image URL" id="img_url" name="img_url" aria-describedby="basic-addon1">
                <p class="fw-light">Please upload your image to other sources first and Use the URL.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary c_btn" type="submit" name="btn-submit" value="submit"> Save Changes </button>
            </div>
        </form>
      </div>
    </div>
</div>
@endsection
