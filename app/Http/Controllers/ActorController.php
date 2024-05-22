<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    public function createActor() {
        return view('createActor');
    }

    public function insertActor(Request $req) {
        $rules = [
            'name' => 'required|min:3',
            'gender' => 'required',
            'biography' => 'required|min:10',
            'dob' => 'required',
            'pob' => 'required',
            'imgUrl' => 'required|mimes:jpeg,jpg,png,gif',
            'popularity' => 'required|numeric'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $actor = new Actor();
            $actor->name = $req->name;
            $actor->gender = $req->gender;
            $actor->biography = $req->biography;
            $actor->date_of_birth = $req->dob;
            $actor->place_of_birth = $req->pob;
            $actor->popularity = $req->popularity;

            // actor thumbnail
            $thumbnail = $req->file('imgUrl');
            $imageName = $actor->name.time().'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/actor_images/', $thumbnail, $imageName);
            $imageName = 'images/actor_images/' . $imageName;
            $actor->img_url = $imageName;

            $actor->save();

            return redirect()->back();
        }
    }

    public function editActor ($id) {
        $actors = Actor::where('id', $id)->first();
        return view('editActor', ['actors' => $actors]);
    }

    public function editDataActor (Request $req, $id) {
        $rules = [
            'name' => 'required|min:3',
            'gender' => 'required',
            'biography' => 'required|min:10',
            'dob' => 'required',
            'pob' => 'required',
            'imgUrl' => 'required|mimes:jpeg,jpg,png,gif',
            'popularity' => 'required|numeric'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $temp = Actor::where('id', $id)->first();
            $temp->name = $req->name;
            $temp->gender = $req->gender;
            $temp->biography = $req->biography;
            $temp->date_of_birth = $req->dob;
            $temp->place_of_birth = $req->pob;
            $temp->popularity = $req->popularity;

            Storage::delete('public/'.$temp->img_url);

            // actor thumbnail
            $thumbnail = $req->file('imgUrl');
            $imageName = $temp->name.time().'.'.$thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/images/actor_images/', $thumbnail, $imageName);
            $imageName = 'images/actor_images/' . $imageName;
            $temp->img_url = $imageName;

            $temp->save();

            return redirect()->back();
        }
    }

    public function viewActors (Request $req) {
        $actors = Actor::where("name", "LIKE", "%$req->search%")->simplePaginate(15);
        return view('viewActors', ['actors' => $actors]);
    }

    public function actorDetails ($id) {
        $actor = Actor::where('id', $id)->first();
        return view('actorDetails', ['actor' => $actor]);
    }

    public function removeActor ($id) {
        $actor = Actor::where('id', $id)->first();
        Storage::delete('public/'.$actor->img_url);
        $actor->delete();

        return redirect()->action([ActorController::class, 'viewActors']);
    }
}
