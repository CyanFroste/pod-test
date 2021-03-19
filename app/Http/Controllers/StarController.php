<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarCreateUpdateRequest;
use App\Models\Star;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StarController extends Controller
{

    public function index(Request $request)
    {

        $stars = Star::with('movies');

        // actor
        if ($request->has('actor')) {
            $stars->where('actor', (bool) $request->actor);
        }

        // cosplayer
        if ($request->has('cosplayer')) {
            $stars->where('cosplayer', (bool) $request->cosplayer);
        }

        // model
        if ($request->has('model')) {
            $stars->where('model', (bool) $request->model);
        }

        // favorite
        if ($request->has('favorite')) {
            $stars->where('favorite', (bool) $request->favorite);
        }

        // name

        // ethnicity

        // search

        return response($stars->paginate(20)->withQueryString());
    }

    public function store(StarCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $star = Star::create($validated);
        // ? attach movies
        return response($star);
    }

    public function show($id)
    {
        try {
            return response(Star::with('movies')->findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(StarCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Star::findOrFail($id)->update($validated);
            // ? attach movies
            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Star::destroy($id);
        return response(null, 204);
    }
}
