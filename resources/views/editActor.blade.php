@extends('template')

@section('title', 'MovieList | Edit Actor')

@section('css')
<link rel="stylesheet" href="{{ asset('css/addEditForm.css') }}">
@endsection

@section('content')
@if ($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
<div class="fs-3 text fw-bolder">Edit Actor</div>
<form action="/actors/editData/{{$actors->id}}" method="post" enctype="multipart/form-data" class="row g-3">
    @csrf
    <div class="col-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" placeholder="{{$actors->name}}">
    </div>
    <div class="col-12">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" class="form-select">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="col-12">
        <label for="biography" class="form-label">Biography</label>
        <textarea class="form-control" name="biography" rows="3" placeholder="{{$actors->biography}}"></textarea>
    </div>
    <div class="col-12">
        <label for="dob" class="form-label">Date of birth</label>
        <input type="date" name="dob" class="form-control">
    </div>
    <div class="col-12">
        <label for="pob" class="form-label">Place of birth</label>
        <input type="text" name="pob" class="form-control" placeholder="{{$actors->place_of_birth}}">
    </div>
    <div class="mb-3">
        <label for="imgUrl" class="form-label">Image Url</label>
        <input class="form-control" type="file" name="imgUrl">
    </div>
    <div class="col-12">
        <label for="popularity" class="form-label">Popularity</label>
        <input type="text" name="popularity" class="form-control" placeholder="{{$actors->popularity}}">
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-danger" type="submit">Save Changes</button>
    </div>
</form>
@endsection
