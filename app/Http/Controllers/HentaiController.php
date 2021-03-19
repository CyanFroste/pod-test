<?php

namespace App\Http\Controllers;

use App\Http\Requests\HentaiCreateUpdateRequest;
use App\Models\Hentai;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HentaiController extends Controller
{
    public function index(Request $request)
    {
        $hentai = Hentai::with('tags')->with('studio')->with('artist');

        // tag
        if ($request->tag) {
            $hentai->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
                // ? orWhere to search by `id`
            });
        }

        // artist
        if ($request->artist) {
            $hentai->whereHas('artists', function ($query) use ($request) {
                $query->where('name', $request->artist);
            });
        }

        // anime
        if ($request->has('anime')) {
            $hentai->where('anime', (bool) $request->anime);
        }

        // doujin
        if ($request->has('doujin')) {
            $hentai->where('doujin', (bool) $request->doujin);
        }

        // 3d
        if ($request->has('3d')) {
            $hentai->where('3d', (bool) $request['3d']);
        }

        // favorite
        if ($request->has('favorite')) {
            $hentai->where('favorite', (bool) $request->favorite);
        }

        // code
        if ($request->code) {
            $hentai->where('code', $request->code);
        }

        // origin

        // language

        // name

        // search

        return response($hentai->paginate(20)->withQueryString());
    }

    public function store(HentaiCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $hentai = Hentai::create($validated);

        // attach tags
        // no validation tho
        if ($request->tags) {
            $hentai->tags()->syncWithoutDetaching((array) $request->tags);
        }

        return response($hentai);
    }

    public function show($id)
    {
        try {
            // eager loading
            $hentai = Hentai::with('tags')->with('studio')->with('artist')->findOrFail($id);
            return response($hentai);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(HentaiCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $hentai = Hentai::findOrFail($id);
            $hentai->update($validated);

            // attach tags
            // no validation tho
            if ($request->tags) {
                $hentai->tags()->syncWithoutDetaching((array) $request->tags);
            }

            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Hentai::destroy($id);
        return response(null, 204);
    }
}
