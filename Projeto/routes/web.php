<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\AuthController;
use App\Http\Controllers\WEB\WebPostController;
use App\Http\Controllers\WEB\WebUDVoteController;
use App\Http\Controllers\WEB\ModController;
use App\Http\Controllers\WEB\WebPostTranslation;
use App\Http\Controllers\WEB\UserController;


//Rotas de login, register e logout

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); //Vai para a view login
Route::post('/login', [AuthController::class, 'signin']); // Faz o processo de autenticação

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register'); //Vai para a view register
Route::post('/register', [AuthController::class, 'signup']); // Faz o processo de criar conta

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Rotas de users autenticados
Route::middleware('auth')->group(function () {
    Route::get('/', [WebPostController::class, 'index'])->name('home');
    Route::get('/posts/create', [WebPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [WebPostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [WebPostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [WebPostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [WebPostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [WebPostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{id}/report', [WebPostController::class, 'report'])->name('posts.report');
    Route::post('/posts/{id}/report', [WebPostController::class, 'reportPost'])->name('posts.report.post');
    Route::get('/posts/{id}/grafico', [WebPostController::class, 'showGraph'])->name('posts.graph');
    
    Route::post('/posts/{id}/vote', [WebUDVoteController::class, 'vote'])->name('posts.vote');

    Route::get('/posts-translation', [WebPostTranslation::class, 'index'])->name('translations.index');
    Route::get('/posts-translation/create', [WebPostTranslation::class, 'create'])->name('translations.create');
    Route::post('/posts/{id}/translate', [WebPostTranslation::class, 'store'])->name('posts.translation.store');
    Route::get('/posts-translation/{id}', [WebPostTranslation::class, 'show'])->name('translations.showTranslation');
    Route::get('/posts-translation/{id}/edit', [WebPostTranslation::class, 'edit'])->name('posts-translation.edit');
    Route::put('/posts-translation/{id}', [WebPostTranslation::class, 'update'])->name('posts-translation.update');
    Route::delete('/posts-translation/{id}', [WebPostTranslation::class, 'destroy'])->name('posts-translation.destroy');

    Route::get('/posts/{id}/moderation', [ModController::class, 'moderation'])->name('posts.moderation');
    Route::get('/posts/{id}/delete', [ModController::class, 'delete'])->name('posts.delete');
    Route::post('/posts/{id}/delete', [ModController::class, 'deletePost'])->name('posts.delete.post');

    Route::get('/posts/{id}/moderation_translation', [ModController::class, 'moderations_translation'])->name('posts.moderation_translation');
    Route::get('/posts/{id}/moderationTranslation/validate', [ModController::class, 'validateById'])->name('posts.validateById');
    Route::post('/posts/{id}/moderationTranslation/validate', [ModController::class, 'validate_Translation'])->name('posts.validate_Translation');

    Route::get('/dashboard/user', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::prefix('dashboard')->group(function () {
        Route::get('/moderator', [ModController::class, 'dashboard'])->name('moderator.dashboard');
        Route::get('/moderator/reports', [ModController::class, 'reports'])->name('moderator.reports');
    });
});

Route::get('/', [WebPostController::class, 'index'])->name('home');

