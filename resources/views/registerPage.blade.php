@extends('template')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('title', 'MovieList | Register')

@section('content')
<h1>Hello, Welcome to<img id="logo-h1" src="{{ asset('assets/logo.png') }}" alt=""></h1>
@if ($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif

<form action="/registerPage" method="POST">
    @csrf
    <div class="input-group mb-3">
        <label for="name" class="input-group-text c_form-label">Username</label>
        <input type="text" class="form-control c_form-input" placeholder="Enter your email" id="name" name="name" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <label for="email" class="input-group-text c_form-label">Email</label>
        <input type="text" class="form-control c_form-input" placeholder="Enter your email" id="email" name="email" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <label for="password" class="input-group-text c_form-label">Password</label>
        <input type="password" class="form-control c_form-input" placeholder="Enter your password" id="password" name="password" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <label for="password_conf" class="input-group-text c_form-label">Confirm Password</label>
        <input type="password" class="form-control c_form-input" placeholder="Enter your confirm password" id="password_conf" name="password_conf" aria-describedby="basic-addon1">
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary c_btn" type="submit" name="btn-submit" value="submit">Register <i class="fa fa-arrow-right"></i></button>
    </div>
    <h6>Already have an account? <a href="/loginPage"><span class="red-text">Login now!</span></a></h6>
</form>
@endsection
