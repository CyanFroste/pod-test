<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagCreateUpdateRequest;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {

        $tags = Tag::orderBy('count', 'desc');

        // favorite
        if ($request->has('favorite')) {
            $tags->where('favorite', (bool) $request->favorite);
        }

        // name

        // search

        return response($tags->paginate(20)->withQueryString());
    }

    public function store(TagCreateUpdateRequest $request)
    {
        $validated = $request->validated();
        $tag = Tag::create($validated);
        return response($tag);
    }

    public function show($id)
    {
        try {
            return response(Tag::findOrFail($id));
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function update(TagCreateUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            Tag::findOrFail($id)->update($validated);
            return response(null, 204);
        } catch (ModelNotFoundException $ex) {
            return response(['message' => 'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        return response(null, 204);
    }
}
