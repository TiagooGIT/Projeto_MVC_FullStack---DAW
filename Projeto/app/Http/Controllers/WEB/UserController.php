<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\WEB\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $userPosts = $user->posts()->with('votes')->get();
        return view('dashboard.user', compact('userPosts'));
    }
}
