<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $req) {
        $carousels = MovieController::getRandomMovies(3);
        $popular = MovieController::getMostPopular();
        $genres = GenreController::getAllGenres();
        
        if ($req->search != null) {
            $query = $req->search;
            $searchMovies = MovieController::searchMovies($query);
            return view('index', ['carousels' => $carousels, 'popular' => $popular, 'genres' => $genres, 'movies' => $searchMovies, 'query' => $query]);
        }
        
        if ($req->genre != null) {
            $genre = $req->genre;
            $genreId = GenreController::getGenreId($genre);
            $movies = MovieController::getMoviesByGenre($genreId);
            return view('index', ['carousels' => $carousels, 'popular' => $popular, 'genres' => $genres, 'movies' => $movies, 'genre' => $genre]);
        }
        
        if ($req->sort != null) {
            $sort = $req->sort;
            $movies = MovieController::sortMovies($sort);
            return view('index', ['carousels' => $carousels, 'popular' => $popular, 'genres' => $genres, 'movies' => $movies, 'sort' => $sort]);
        }
        $movies = MovieController::getAllMovies();
        return view('index', ['carousels' => $carousels, 'popular' => $popular, 'genres' => $genres, 'movies' => $movies]);
    }
}
