<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudioCreateUpdateRequest;
use App\Models\Studio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StudioController extends Controller
{

    public function index(Request $request)
    {

        $studios = Studio::with('movies')->with('hentai');

        // hentai
        if ($request->has('hentai')) {
            $studios->where('hentai', (bool) $request->hentai);
        }

        // movie
        if ($request->has('movie')) {
            $studios->where('movie', (bool) $request->movie);
        }

        // favorite
        if ($request->has('favorite')) {
            $studios->where('favorite', (bool) $request->favorite);
        }

        // name

        // search

        return response($studios->paginate(20)->withQueryString());
    }

    public function store(StudioCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $studio = Studio::create($validated);
        return response($studio);
    }

    public function show($id)
    {
        try {
            return response(Studio::with('movies')->with('hentai')->findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(StudioCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Studio::findOrFail($id)->update($validated);
            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Studio::destroy($id);
        return response(null, 204);
    }
}
