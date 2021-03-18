<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudioCreateUpdateRequest;
use App\Models\Studio;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudioController extends Controller
{

    public function index()
    {
        return response(Studio::paginate(20));
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
            return response(Studio::findOrFail($id));
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
