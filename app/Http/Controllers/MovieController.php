<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    public function createMovie() {
        $genres = Genre::all();
        $actors = Actor::all();
        return view('createMovie', ['genres' => $genres, 'actors' => $actors]);
    }

    public function insertMovie (Request $req) {
        $rules = [
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genre' => 'required|array|min:1',
            'genre.*' => 'required|string|distinct',
            'actors' => 'required|array|min:1',
            'actors.*' => 'required|string|distinct',
            'characters' => 'required|array|min:1',
            'characters.*' => 'required|string|distinct',
            'director' => 'required|min:3',
            'releaseDate' => 'required',
            'imgUrl' => 'required|mimes:jpeg,jpg,png,gif',
            'backgroundUrl' => 'required|mimes:jpeg,jpg,png,gif'
        ];
        $validator = Validator::make($req->all(), $rules);
        // dump($req);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $movie = new Movie();
            $movie->title = $req->title;
            $movie->description = $req->description;
            $movie->director = $req->director;
            $movie->release_date = $req->releaseDate;

            // movie thumbnail
            $thumbnail = $req->file('imgUrl');
            $imageName = $movie->title.$movie->release_date.'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/movie_images/', $thumbnail, $imageName);
            $imageName = 'images/movie_images/'.$imageName;
            $movie->img_url = $imageName;

            // movie background
            $thumbnail = $req->file('backgroundUrl');
            $imageName = $movie->title.$movie->release_date.'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/movie_backgrounds/', $thumbnail, $imageName);
            $imageName = 'images/movie_backgrounds/'.$imageName;
            $movie->background_url = $imageName;
            $movie->save();

            // genres
            foreach ($req->genre as $g) {
                $genre = Genre::where('genre', $g)->first();
                $movie->genres()->attach($genre->id);
            }

            // actors & character names
            for ($i = 0; $i < sizeof($req->actors); $i++) {
                $actor = Actor::where('name', $req->actors[$i])->first();
                $movie->actors()->attach($actor->id, ['character_name' => $req->characters[$i]]);
            }

            return redirect()->back();
        }
    }

    public function editMovie ($id) {
        $movie = Movie::where('id', $id)->first();
        $genres = Genre::all();
        $actors = Actor::all();
        return view('editMovie', ['movie' => $movie], ['genres' => $genres, 'actors' => $actors]);
    }

    public function editDataMovie (Request $req, $id) {
        $rules = [
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genre' => 'required|array|min:1',
            'genre.*' => 'required|string|distinct',
            'actors' => 'required|array|min:1',
            'actors.*' => 'required|string|distinct',
            'characters' => 'required|array|min:1',
            'characters.*' => 'required|string|distinct',
            'director' => 'required|min:3',
            'releaseDate' => 'required',
            'imgUrl' => 'required|mimes:jpeg,jpg,png,gif',
            'backgroundUrl' => 'required|mimes:jpeg,jpg,png,gif'
        ];
        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $temp = Movie::where('id', $id)->first();
            $temp->title = $req->title;
            $temp->description = $req->description;
            $temp->director = $req->director;
            $temp->release_date = $req->releaseDate;

            Storage::delete('public/'.$temp->img_url);
            Storage::delete('public/'.$temp->background_url);
            
            // movie thumbnail
            $thumbnail = $req->file('imgUrl');
            $imageName = $temp->title.$temp->release_date.'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/movie_images/', $thumbnail, $imageName);
            $imageName = 'images/movie_images/'.$imageName;
            $temp->img_url = $imageName;

            // movie background
            $thumbnail = $req->file('backgroundUrl');
            $imageName = $temp->title.$temp->release_date.'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/movie_backgrounds/', $thumbnail, $imageName);
            $imageName = 'images/movie_backgrounds/'.$imageName;
            $temp->background_url = $imageName;
            $temp->save();

            // genres
            $temp->genres()->detach();
            foreach ($req->genre as $g) {
                $genre = Genre::where('genre', $g)->first();
                $temp->genres()->attach($genre->id);
            }

            // actors & character names
            $temp->actors()->detach();
            for ($i = 0; $i < sizeof($req->actors); $i++) {
                $actor = Actor::where('name', $req->actors[$i])->first();
                $temp->actors()->attach($actor->id, ['character_name' => $req->characters[$i]]);
            }

            return redirect()->back();
        }
    }

    public function removeMovie($id) {
        $movie = Movie::find($id);
        Storage::delete('public/' . $movie->img_url);
        $movie->delete();

        return redirect('/movies');
    }

    public function viewMovies (Request $req) {
        $movies = Movie::where("title", "LIKE", "%$req->search%")->simplePaginate(15);
        return view('viewMovies', ['movies' => $movies]);
    }

    public function movieDetails($id) {
        $movie = Movie::find($id);
        $more = $this->findSimilarMovie($movie);
        return view('movieDetails', ['movie' => $movie, 'more' => $more]);
    }

    public static function getRandomMovies($n) {
        return Movie::inRandomOrder()->limit($n)->get();
    }

    public static function getMostPopular() {
        $popular = Movie::withCount('watchlists')->orderBy('watchlists_count')->get();
        return $popular;
    }

    public static function searchMovies($query) {
        $movies = Movie::where('title', 'LIKE', "%$query%")->get();
        return $movies;
    }

    public static function getAllMovies() {
        return Movie::all();
    }

    public static function getMoviesByGenre($genreId) {
        $movies = Movie::whereHas('genres', function($query) use ($genreId) {
            $query->where('genre_id', $genreId);
        })->get();
        return $movies;
    }

    public static function sortMovies($sort) {
        if ($sort == 'latest') {
            return Movie::all()->sortByDesc('release_date');
        } else if ($sort == 'ascending') {
            return Movie::orderBy('title')->get()->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE);
        } else if ($sort == 'descending') {
            return Movie::orderBy('title')->get()->sortByDesc('title', SORT_NATURAL | SORT_FLAG_CASE);
        }
    }

    public function findSimilarMovie($movie) {
        $genres_id = [];
        foreach($movie->genres as $g) {
            array_push($genres_id, $g->id);
        }

        $id = $movie->id;
        $more = Movie::whereHas('genres', function($query) use ($genres_id, $id) {
            $query->whereIn('genre_id', $genres_id)->where('movie_id', '!=', $id);
        })->get();

        return $more;
    }

    // public function viewActorMovie($id) {
    //     $genres = Genre::all();
    //     $actors = Actor::all();
    //     return view('createMovie', ['genres' => $genres, 'actors' => $actors]);
    // }
}
