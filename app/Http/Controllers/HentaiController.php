<?php

namespace App\Http\Controllers;

use App\Http\Requests\HentaiCreateUpdateRequest;
use App\Models\Hentai;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HentaiController extends Controller
{
    public function index()
    {
        return response(Hentai::with('tags')->with('studio')->with('artist')->paginate(20));
    }

    public function store(HentaiCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $hentai = Hentai::create($validated);

        // attach tags
        // no validation tho
        if ($request->tags)
            $hentai->tags()->syncWithoutDetaching((array)$request->tags);

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
            if ($request->tags)
                $hentai->tags()->syncWithoutDetaching((array)$request->tags);

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
