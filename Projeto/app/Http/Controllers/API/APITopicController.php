<?php

namespace App\Http\Controllers\API;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\WEB\Controller as Controller;

class APITopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return response()->json($topics);
    }

    public function show($id)
    {
        $topic = Topic::findOrFail($id);
        return response()->json($topic);
    }

    public function store(Request $request)
    {
        $topic = Topic::create($request->all());
        return response()->json($topic, 201);
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return response()->json($topic, 200);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return response()->json(null, 204);
    }
}
