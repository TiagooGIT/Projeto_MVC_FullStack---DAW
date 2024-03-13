<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\WEB\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostDelete;
use App\Models\PostReport;
use App\Models\Post_translated;
use App\Models\PostInteraction;

class APIModController extends Controller
{

    public function moderation($postId): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($postId);

        return response()->json(['data' => $post], 201); 
    }

    public function delete($postId): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($postId);

        return response()->json(['data' => $post], 201);
    }

    public function deletePost(Request $request, $postId): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $post = Post::findOrFail($postId);
        $moderator = auth()->user();

        PostDelete::create([
            'title' => $post->titulo,
            'content' => $post->conteudo,
            'id_user' => $post->id_user,
            'deleted_by' => $moderator->id_user,
            'reason' => $request->input('reason'),
        ]);

        // Eliminar o post
        $post->delete();

        return response()->json(['data' => $post], 201);
    }


    public function Validation(Request $request, $postId): \Illuminate\Http\JsonResponse
    {
        $request->validate([

            'validacao' => 'required',
            'comentario_validacao'
        ]);

        $post_translated = Post_translated::where('id_post', $postId)
            ->where('validacao', '!=', 1)
            ->first();

        $id_post_translated = Post_translated::where('id_post', $postId)
            ->where('validacao', '!=', 1)
            ->value('id_post_translated');

        if ($request->input('validacao') == 0) {

            $post_translated->delete();

            PostInteraction::create([
                'id_post' => $postId,
                'action' => 'traducao_eliminada',
    
            ]);
        } else {

            $post_translated->update([
                'validacao' => $request->validacao,
                'comentario_validacao' => $request->comentario_validacao,
            ]);

            PostInteraction::create([
                'id_post' => $postId,
                'action' => 'traducao_validada',
    
            ]);
        }
        return response()->json(['data' => $post_translated], 201);
    }


    public function moderations_translation($postId): \Illuminate\Http\JsonResponse
    {
        $post_translated = Post_translated::where('id_post', $postId)->get();
        return response()->json(['data' => $post_translated], 201);
    }

    public function validateById($postId): \Illuminate\Http\JsonResponse
    {
        $post_translated = Post_translated::where('id_post', $postId)
            ->where('validacao', '!=', 1)
            ->first();

        return response()->json(['data' => $post_translated], 201);
    }

    public function dashboard()
    {
        $deletedPosts = PostDelete::all(); 
        return response()->json(['data' => $deletedPosts], 201);

    }

    public function reports()
    {
        $reportedPosts = PostReport::all(); 
        return response()->json(['data' => $reportedPosts], 201);
    }

 
}
