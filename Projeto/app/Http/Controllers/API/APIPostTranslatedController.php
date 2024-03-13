<?php

namespace App\Http\Controllers\API;

use App\Models\PostApiId;
use App\Models\Post_translated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WEB\Controller as Controller;
use App\Models\PostInteraction;

class APIPostTranslatedController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $postsTranslated = Post_translated::all();
        return response()->json($postsTranslated);
    }

    public function show(): \Illuminate\Http\JsonResponse
    {
        $postTranslated = Post_translated::latest()->first(); //vai buscar sempre a ultima traduçao ( evita erros)
        return response()->json(['data' => $postTranslated]);
    }

    public function store(Request $request, $id): \Illuminate\Http\JsonResponse
    {

        $request->validate([
            'id_language' => 'required|numeric',
        ]);


        $user = Auth::user();
        $api_post_id = PostApiId::where('local_post_id', $id)->value('api_post_id');

        $apiFluentMeController = new APIFluentMeController();
        $apiResponse = $apiFluentMeController->sendPostToTranslate($api_post_id, $request->id_language);


        if ($apiResponse->successful()) {
            // Decodifica a resposta da API 
            $translatedPostId = json_decode($apiResponse->body())->post_id;
            $translatedLanguageId = json_decode($apiResponse->body())->post_language_id;
            $translatedPost_title = json_decode($apiResponse->body())->post_title;
            $translatedPost_content = json_decode($apiResponse->body())->post_content;


            PostInteraction::create([
                'id_post' => $id,
                'action' => 'traducao',
            ]);


            // Atualiza a tabela postsAPI_IDs tendo em conta o local_post_id
            PostApiId::updateOrCreate(
                ['local_post_id' => $id],
                ['api_translated_post_id' => $translatedPostId]
            );

            // Salva na tabela Post_translated a traduçao
            $post_translated = Post_translated::create([
                'id_post' => $id,
                'id_language' => $translatedLanguageId,
                'titulo' => $translatedPost_title,
                'conteudo' => $translatedPost_content,
                'id_user' => $user->id_user

            ]);

            return response()->json(['data' => $post_translated], 201);
        } else {
            // Em caso de falha no envio para a API
            return response()->json(['error' => 'Erro ao enviar post para a API.'], $apiResponse->status());
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $postTranslated = Post_translated::findOrFail($id);
        $postTranslated->update($request->all());
        return response()->json($postTranslated, 200);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $postTranslated = Post_translated::findOrFail($id);
        $postTranslated->delete();
        return response()->json(null, 204);
    }
}
