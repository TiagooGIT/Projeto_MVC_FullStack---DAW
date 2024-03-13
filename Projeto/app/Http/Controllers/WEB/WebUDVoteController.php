<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\WEB\Controller;
use App\Models\UDVote;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebUDVoteController extends Controller
{
    public function vote(Request $request, $postId)
    {
        $post = Post::find($postId);
        $user = auth()->user();
        $vote = $request->input('vote');

        if (!in_array($vote, ['up', 'down'])) {
            return redirect()->back()->with('error', 'Voto inválido.');
        }

        $existingVote = UDVote::where('id_post', $post->id_post)
            ->where('id_user', $user->id_user)
            ->first();

            if ($existingVote) {
                if ($existingVote->vote === $vote) {
                    // Se o usuário já votou no mesmo post com o mesmo voto, remova o voto
                    $existingVote->delete();
                } else {
                    // Se o voto é diferente, atualize o voto
                    $existingVote->update(['vote' => $vote]);
                }
            } else {
                // Se não existir, adicione o voto
                UDVote::create([
                    'id_user' => $user->id_user,
                    'id_post' => $post->id_post,
                    'vote' => $vote,
                ]);
            }
        

        return redirect()->back()->with('success', 'Voto registrado com sucesso.');
    }

}