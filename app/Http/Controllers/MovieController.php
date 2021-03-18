<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCreateUpdateRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MovieController extends Controller
{
    public function index()
    {
        return response(Movie::paginate(20));
    }

    public function store(MovieCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $movie = Movie::create($validated);
        // attach stars
        // attach tags
        return response($movie);
    }

    public function show($id)
    {
        try {
            return response(Movie::findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(MovieCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Movie::findOrFail($id)->update($validated);
            // attach stars
            // attach tags
            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Movie::destroy($id);
        return response(null, 204);
    }
}
