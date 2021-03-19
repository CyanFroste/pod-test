<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistCreateUpdateRequest;
use App\Models\Artist;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArtistController extends Controller
{

    public function index()
    {
        return response(Artist::with('hentai')->paginate(20));
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
