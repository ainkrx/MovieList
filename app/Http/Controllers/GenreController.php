<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public static function getAllGenres() {
        return Genre::all();
    }

    public static function getGenreId($genre) {
        return Genre::where('genre', $genre)->first()->id;
    }
}
