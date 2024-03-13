<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\AuthController;
use App\Http\Controllers\API\APIPostController;
use App\Http\Controllers\API\APIPostTranslatedController;
use App\Http\Controllers\API\APIModController;
use App\Http\Controllers\API\APIFluentMeController;
use App\Http\Controllers\API\APITopicController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'signin']);
Route::post('/register', [AuthController::class, 'signup']);

Route::get('/fetch-languages', [APIFluentMeController::class, 'fetchAndStoreLanguages']);
Route::post('/send-post', [APIFluentMeController::class, 'sendPost']);
Route::post('/send-post-translate/{api_post_id}/{id_language}', [APIFluentMeController::class, 'sendPostToTranslate']);

Route::get('/moderation/{postId}', [APIModController::class, 'moderation']);
Route::get('/delete/{postId}', [APIModController::class, 'delete']);
Route::post('/delete-post/{postId}', [APIModController::class, 'deletePost']);
Route::post('/validation/{postId}', [APIModController::class, 'Validation']);
Route::get('/moderations-translation/{postId}', [APIModController::class, 'moderations_translation']);
Route::get('/validate-by-id/{postId}', [APIModController::class, 'validateById']);
Route::get('/dashboard', [APIModController::class, 'dashboard']);
Route::get('/reports', [APIModController::class, 'reports']);



Route::get('/posts', [APIPostController::class, 'index']); //rotas onde acede se aos dados em json
Route::get('/posts/{id}', [APIPostController::class, 'show']);
Route::post('/posts', [APIPostController::class, 'store']);
Route::put('/posts/{id}', [APIPostController::class, 'update']);
Route::delete('/posts/{id}', [APIPostController::class, 'destroy']);
Route::post('/posts/{postId}/report', [APIPostController::class, 'reportPost']);
Route::get('/posts/create', [APIPostController::class, 'create']);

Route::get('/post/translation', [APIPostTranslatedController::class, 'index']);
Route::get('/post/translation/{id}', [APIPostTranslatedController::class, 'show']);
Route::post('/post/translation/{id}', [APIPostTranslatedController::class, 'store']);
Route::put('/post/translation/{id}', [APIPostTranslatedController::class, 'update']);
Route::delete('/post/translation/{id}', [APIPostTranslatedController::class, 'destroy']);

Route::get('/topics', [APITopicController::class, 'index']);
Route::get('/topics/{id}', [APITopicController::class, 'show']);
Route::post('/topics', [APITopicController::class, 'store']);
Route::put('/topics/{id}', [APITopicController::class, 'update']);
Route::delete('/topics/{id}', [APITopicController::class, 'destroy']);

Route::post('/posts/{id}/delete', [APIModController::class, 'deletePost']);


