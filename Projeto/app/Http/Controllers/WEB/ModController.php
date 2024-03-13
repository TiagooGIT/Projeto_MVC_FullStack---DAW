<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\WEB\Controller;
use App\Http\Controllers\API\APIModController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostReport;
use App\Models\PostDelete;
use App\Models\Post_translated;

class ModController extends Controller
{
    public function moderation($postId)
    {
        $apiModController = new APIModController();
        $response = $apiModController->moderation($postId);
        $post = $response->original['data'];
        return view('mod.moderation', compact('post'));
    }

    public function moderations_translation($postId)
    {
        $apiModController = new APIModController();
        $response = $apiModController->moderations_translation($postId);
        $posts_translated = $response->original['data'];
        return view('mod.moderation_Translation', compact('posts_translated'));
    }

    public function validateById($postId)
    {
        $apiModController = new APIModController();
        $response = $apiModController->validateById($postId);
        $posts_translated = $response->original['data'];
        return view('mod.validation', compact('posts_translated'));
    }


    public function validate_Translation(Request $request, $postId, APIModController $apiModController)
    {
        $apiResponse = $apiModController->Validation($request, $postId);

        if ($apiResponse->getStatusCode() == 201) {
            return redirect()->route('posts.moderation_translation', ['id' => $postId])->with('success', 'Validação Executada com Sucesso.');
        } else {
            return redirect()->route('home')->with('error', 'Falha ao eliminar o post.');
        }
    }


    public function delete($postId)
    {
        $apiModController = new APIModController();
        $response = $apiModController->delete($postId);
        $post = $response->original['data'];

        return view('mod.delete', compact('post')); // (nome da pasta da view).(nome)
    }


    public function deletePost(Request $request, $postId, APIModController $apiModController)
    {
        $apiResponse = $apiModController->deletePost($request, $postId);
        if ($apiResponse->getStatusCode() == 201) {
            return redirect()->route('home')->with('success', 'Post eliminado com sucesso.');
        } else {
            return redirect()->route('home')->with('error', 'Falha ao eliminar o post.');
        }
    }

    public function dashboard()
    {
        $apiModController = new APIModController();
        $response = $apiModController->dashboard();
        $deletedPosts = $response->original['data'];
    
        return view('dashboard.moderator.moderator', compact('deletedPosts'));
    }

    public function reports()
    {
        $apiModController = new APIModController();
        $response = $apiModController->reports();
        $reportedPosts = $response->original['data'];

        return view('dashboard.moderator.reports', compact('reportedPosts'));
    }
}
