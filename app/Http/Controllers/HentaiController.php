<?php

namespace App\Http\Controllers;

use App\Http\Requests\HentaiCreateUpdateRequest;
use App\Models\Hentai;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HentaiController extends Controller
{
    public function index()
    {
        return response(Hentai::paginate(20));
    }

    public function store(HentaiCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $hentai = Hentai::create($validated);
        // attach tags
        return response($hentai);
    }

    public function show($id)
    {
        try {
            return response(Hentai::findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(HentaiCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Hentai::findOrFail($id)->update($validated);
            // attach tags
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
