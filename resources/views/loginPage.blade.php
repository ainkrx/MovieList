@extends('template')

@section('css')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('title', 'MovieList | Login')

@section('content')
<h1>Hello, Welcome back to<img id="logo-h1" src="{{ asset('assets/logo.png') }}" alt=""></h1>
@if ($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif
<form action="/loginPage" method="POST">
    @csrf
    <div class="input-group mb-3">
        <label for="email" class="input-group-text c_form-label">Email</label>
        <input type="text" class="form-control c_form-input" placeholder="Enter your email" id="email" name="email" value="{{Cookie::get('mycookie') !== null ? Cookie::get('mycookie') : ''}}" aria-label=" Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <label for="password" class="input-group-text c_form-label">Password</label>
        <input type="password" class="form-control c_form-input" placeholder="Enter your password" id="password" name="password" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="form-check">
        @if(Cookie::get('mycookie') !== null)
            <input class="form-check-input" type="checkbox" name="remember" checked>
        @else
            <input class="form-check-input" type="checkbox" name="remember">
        @endif
        <label class="form-check-label" for="remember"> Remember me </label>
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary c_btn" type="submit" name="btn-submit" value="submit">Login <i class="fa fa-arrow-right"></i></button>
    </div>
    <h6>Don't have an account? <a href="/registerPage"><span class="red-text">Register now!</span></a></h6>
</form>
@endsection
