<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Models\PostApiId;
use App\Models\Post_translated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\PostReport;
use App\Models\PostInteraction;
use App\Models\Language;
use App\Http\Controllers\WEB\Controller;
use App\Http\Controllers\API\APIFluentMeController;

class APIPostController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $posts = Post::all();
        return response()->json(['data' => $posts]);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($id);
        $posts_translated = Post_translated::where('id_post', $id)->get();

        return response()->json(['data' => $post, 'data2' => $posts_translated]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'titulo' => 'required',
            'conteudo' => 'required',
            'id_language' => 'required|numeric',
        ]);

        //Obter o user autenticado
        $user = Auth::user();

        // Crie o post localmente associando o user
        $post = $user->posts()->create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'id_language' => $request->id_language,
        ]);

        // Post Criado localmente
        //return response()->json(['data' => $post], 201);

        
        // Envia para a API thefluentme
        $apiFluentMeController = new APIFluentMeController();
        $apiResponse = $apiFluentMeController->sendPost($request->titulo, $request->conteudo, $request->id_language);

        // Verifica se o envio para a API foi bem-sucedido
        //if ($apiResponse->getStatusCode() >= 200 && $apiResponse->getStatusCode() < 300) {
        if ($apiResponse->successful()) {
            // Decodifica a resposta da API para obter o ID retornado
            $apiPostId = json_decode($apiResponse->body())->post_id;

            // Salva na tabela postsAPI_IDs
            PostApiId::create([
                'local_post_id' => $post->id_post,
                'api_post_id' => $apiPostId,
            ]);

            return response()->json(['data' => $post], 201);
        } else {
            // Em caso de falha no envio para a API
            return response()->json(['error' => 'Erro ao enviar post para a API.'], $apiResponse->status());
        }
        
        
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'titulo' => 'required',
            'conteudo' => 'required',
        ]);

        $user = Auth::user();
        $post = $user->posts()->findOrFail($id);
        $post->update([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
        ]);

        return response()->json(['data' => $post]);
    }

    public function report($postId): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($postId);

        return response()->json(['data' => $post], 201);
    }

    public function create(): \Illuminate\Http\JsonResponse
    {
        $languages = Language::all();
        return response()->json(['data' => $languages], 201);
    }

    public function reportPost(Request $request, $postId): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'reason' => 'required|string',
        ]);

        $post = Post::find($postId);
        $user = auth()->user();

        // Certifique-se de que o post existe antes de prosseguir
        if (!$post) {
            return response()->json(['error' => 'Post não encontrado.']);
        }

        // Certifique-se de que há um user autenticado
        if (!$user) {
            return response()->json(['error' =>  'User não autenticado.']);
        }

        $isOwner = auth()->check() && auth()->user()->id_user === $post->user->id_user;

        if (!$isOwner) {
            $post->interactions()->create(['action' => 'report']);
        }

        // Crie o relatório do post
        PostReport::create([
            'id_post' => $post->id_post,
            'id_user' => $user->id_user,
            'reason' => $request->input('reason'),
        ]);

        return response()->json(['data'], 201);

    }
}
