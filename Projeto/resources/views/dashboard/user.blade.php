@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div>
            <h1 class="text-center fw-bold">Dashboard do {{ auth()->user()->name }}</h1>

            <h2 class="mt-4 text-center">Os Teus Posts</h2>

            @foreach($userPosts as $post)
                <div class="card mb-3 mx-auto" style="max-width: 800px;">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user me-2"></i> 
                            <p class="card-text fs-5">{{ $post->user->name }}</p>
                        </div>
                        <div class="d-flex">
                            <p class="card-text me-2">
                                <i class="fas fa-thumbs-up text-success"></i>
                                {{ $post->votes ? $post->votes->where('vote', 'up')->count() : 0 }}
                            </p>
                            <p class="card-text">
                                <i class="fas fa-thumbs-down text-danger"></i>
                                {{ $post->votes ? $post->votes->where('vote', 'down')->count() : 0 }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title text-center mb-3 fs-4">{{ $post->titulo }}</h5>
                        <p class="card-text fs-6">{{ $post->conteudo }}</p>
                        <p class="card-text">Lingua: {{ $post->language ? $post->language->language : 'N/A' }}</p>
                    </div>
            
                    <div class="text-center mx-auto">
                        <h4 class="mt-3 fw-bold">Métricas de Interação</h4>
                        <p class="card-text">Cliques em "Ver mais": {{ $post->interactions ? $post->interactions->where('action', 'view_more')->count() : 0 }}</p>
                        <p class="card-text">Traduções: {{ $post->interactions ? $post->interactions->where('action', 'traducao')->count() : 0 }}</p>
                        <p class="card-text">Traduções Validada: {{ $post->interactions ? $post->interactions->where('action', 'traducao_validada')->count() : 0 }}</p>
                        <p class="card-text">Traduções Eliminadas: {{ $post->interactions ? $post->interactions->where('action', 'traducao_eliminada')->count() : 0 }}</p>
                        <p class="card-text">Reports: {{ $post->interactions ? $post->interactions->where('action', 'report')->count() : 0 }}</p>
                        <a href="{{ route('posts.graph', ['id' => $post->id_post]) }}" class="btn btn-primary mt-3 mb-3">Ver Gráfico</a>
                    </div>
        </div>
            @endforeach

            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
            </div>
        </div>
    </div>
@endsection
