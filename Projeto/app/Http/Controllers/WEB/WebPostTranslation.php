<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\Post;
use App\Models\UpDownVote;
use App\Models\PostApiId;

use App\Http\Controllers\API\APIPostTranslatedController as apiTranslatedPost;

class WebPostTranslation extends controller

{
    public function index()
{
    $apiController = new apiTranslatedPost();
    $response = $apiController->index();

    return $this->handleApiResponse($response);
}

public function show($id)
{
    $apiController = new apiTranslatedPost();
    $response = $apiController->show();
    $postTranslated = $response->original['data'];

    return view('translations.showTranslation', compact('postTranslated'));
}

public function create()
{
   
    return view('postsTranslation.create');
}

public function store(Request $request, $id)
{
    $apiController = new apiTranslatedPost();
    $response = $apiController->store($request,$id);
    

    // Verifica se o armazenamento local e o envio para a API foram bem-sucedidos
    if ($response ->getStatusCode() >= 200 && $response ->getStatusCode() < 300) {
        return redirect()->route('translations.showTranslation',$id)->with('success', 'Tradução Criada com Sucesso');
    } else {
        // Em caso de falha no armazenamento local ou no envio para a API
        return redirect()->route('home')->with('error', 'Erro ao criar post ou enviar para a API.');
    }
}

public function edit($id)
{
    
    $apiController = new apiTranslatedPost();
    $response = $apiController->edit($id);

    return $this->handleApiResponse($response);
}

public function update(Request $request, $id)
{
    $apiController = new apiTranslatedPost();
    $response = $apiController->update($request, $id);

    return $this->handleApiResponse($response);
}

public function destroy($id)
{
    $apiController = new apiTranslatedPost();
    $response = $apiController->destroy($id);

    return $this->handleApiResponse($response);
}


}