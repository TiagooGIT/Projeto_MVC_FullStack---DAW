<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UDVote;
use App\Models\PostApiId;
use App\Models\Language;
use App\Models\PostReport;
use App\Models\PostDelete;
use App\Models\PostInteraction;
use App\Models\Traduction_Interaction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\API\APIPostController;

class WebPostController extends controller
{

    public function index()
    {
        $apiController = new ApiPostController(); //cria uma nova instância do controlador ApiPostsController
        $response = $apiController->index(); //chama o método index() do controlador ApiPostsController.
        $posts = $response->original['data']; // extrai os dados dos posts da resposta JSON 
        return view('home', compact('posts')); // retorna mostrando a view Home
    }

    public function create()
    {
        $apiController = new ApiPostController(); 
        $response = $apiController->create(); 
        $languages = $response->original['data'];
        return view('posts.create', compact('languages'));
    }

    public function store(Request $request)
    {
        // Chama o método store() do controlador ApiPostsController.
        $apiController = new ApiPostController();
        $apiResponse = $apiController->store($request);

        // Verifica se o armazenamento local e o envio para a API foram bem-sucedidos
        if ($apiResponse->getStatusCode() >= 200 && $apiResponse->getStatusCode() < 300) {
            return redirect()->route('home')->with('success', 'Post criado e enviado para a API com sucesso!');
        } else {
            // Em caso de falha no armazenamento local ou no envio para a API
            return redirect()->route('home')->with('error', 'Erro ao criar post ou enviar para a API.');
        }
    }

    public function show($id)
    {
        $languages = Language::all();
        $apiController = new ApiPostController();
        $response = $apiController->show($id);
        $post = $response->original['data'];
        $posts_translated = $response->original['data2'];
        $isOwner = auth()->check() && auth()->user()->id_user === $post->user->id_user;

        if (!$isOwner) {
            $post->interactions()->create(['action' => 'view_more']);
        }

        return view('posts.show', compact('post', 'languages', 'posts_translated'));
    }

    public function edit($id)
    {
        $apiController = new ApiPostController();
        $response = $apiController->show($id);
        $post = $response->original['data'];
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        // Chama o método update() do controlador ApiPostsController.
        $apiController = new ApiPostController();
        $apiResponse = $apiController->update($request, $id);

        // Verifica se o armazenamento local e o envio para a API foram bem-sucedidos
        if ($apiResponse->getStatusCode() >= 200 && $apiResponse->getStatusCode() < 300) {
            return redirect()->route('home')->with('success', 'Post atualizado com sucesso!');
        } else {
            // Em caso de falha no armazenamento local ou no envio para a API
            return redirect()->route('home')->with('error', 'Erro ao atualizar post');
        }
    }

    public function report($postId)
    {
        $apiController = new ApiPostController();
        $response = $apiController->report($postId);
        $post = $response->original['data'];
        return view('posts.report', compact('post'));

    }

    public function reportPost(Request $request, $postId)
    {
        $apiController = new ApiPostController();
        $response = $apiController->reportPost($request, $postId);
        return redirect()->route('home')->with('success', 'Post reportado com sucesso.');
    }


    public function showGraph(Request $request, $id)
    {
        $post = Post::find($id);
        $metric = $request->input('metric', 'view_more', 'report', 'tradução', 'tradução_validada', 'tradução_eliminada');
        $interactions = PostInteraction::where('id_post', $id)
            ->where('action', $metric)
            ->get();
            
        $clicks = $interactions->groupBy(function ($interaction) {
            return $interaction->created_at->format('d-m-Y');
        })->map->count();

        $labels = $clicks->keys()->toArray();

        return view('posts.graph', compact('labels', 'clicks', 'post', 'metric'));
    }
}
