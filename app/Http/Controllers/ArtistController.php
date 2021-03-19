<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistCreateUpdateRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArtistController extends Controller
{

    public function index(Request $request)
    {
        $artists = Artist::with('hentai');

        // favorite
        if ($request->has('favorite')) {
            $artists->where('favorite', (bool) $request->favorite);
        }

        // name

        // search

        return response($artists->paginate(20)->withQueryString());
    }

    public function store(ArtistCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        return response(Artist::create($validated));
    }

    public function show($id)
    {
        try {
            return response(Artist::with('hentai')->findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(ArtistCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Artist::findOrFail($id)->update($validated);
            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Artist::destroy($id);
        return response(null, 204);
    }
}
