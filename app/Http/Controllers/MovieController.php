<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieCreateUpdateRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {

        $movies = Movie::with('stars')->with('tags')->with('studio');

        // tag
        if ($request->tag) {
            $movies->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
            });
        }

        // star
        if ($request->star) {
            $movies->whereHas('stars', function ($query) use ($request) {
                $query->where('name', $request->star);
            });
        }

        // studio
        if ($request->studio) {
            $movies->whereHas('studio', function ($query) use ($request) {
                $query->where('name', $request->studio);
            });
        }

        return response($movies->paginate(20)->withQueryString());
    }

    public function store(MovieCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $movie = Movie::create($validated);

        // attach stars
        if ($request->stars) {
            $movie->stars()->syncWithoutDetaching((array) $request->stars);
        }

        // attach tags
        if ($request->tags) {
            $movie->tags()->syncWithoutDetaching((array) $request->tags);
        }

        return response($movie);
    }

    public function show($id)
    {
        try {
            return response(Movie::with('stars')->with('tags')->with('studio')->findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(MovieCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $movie = Movie::findOrFail($id);
            $movie->update($validated);

            // attach stars
            if ($request->stars) {
                $movie->stars()->syncWithoutDetaching((array) $request->stars);
            }

            // attach tags
            if ($request->tags) {
                $movie->tags()->syncWithoutDetaching((array) $request->tags);
            }

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
