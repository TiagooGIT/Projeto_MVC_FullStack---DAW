@extends('layout')

<title>Detalhes do Post - {{ $post->titulo }}</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h2 class="mb-4 fw-bold">Detalhes do Post - {{ $post->titulo }}</h2>

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
    </div>
    
    <div class="card mb-3 mx-auto" style="max-width: 800px;">
        <div class="card-header d-flex justify-content-between">
            <h2 class="mb-4 fw-bold">Traduções Disponíveis</h2>
        </div>    
        @foreach ($posts_translated as $index => $translatedPost)
            <div class="border p-3 mb-3 text-left">
                <h4 class="mb-4 fw-bold">Post Traduzido nº{{ $index + 1 }}</h4>
                <p>{{ $translatedPost->titulo }}</p>
                <p>{{ $translatedPost->conteudo }}</p>
                <p>Língua Traduzida: {{ $translatedPost->language->language }}</p>
                <p>Criado em: {{ $translatedPost->created_at }}</p><br>
                <h4 class="mb-4 fw-bold">Informações sobre a tradução</h4>
                <p>Utilizador Tradutor: {{ $translatedPost->user->name }}</p>
                <p>Validação: {{ $translatedPost->validacao }}</p>
                <p>Comentário da Validação: {{ $translatedPost->comentario_validacao }}</p>
            </div>
        @endforeach
    </div>
    
    @auth
        @if(auth()->user()->id_user !== $post->user->id_user)
            @if(!auth()->user()->moderator)
            <div class="d-flex justify-content-center align-items-center">
                <button id="translateButton" class="btn btn-primary d-block mt-3">Traduzir</button>
            </div>
            @endif
        @endif

        @if(auth()->user()->moderator)
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('posts.moderation_translation', ['id' => $post->id_post]) }}" class="btn btn-warning btn-n d-block mx-auto mt-3">
                    <i class="fas fa-edit me-2"></i> Validar Tradução
                </a>
            </div>
        @endif

        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('home') }}" class="btn btn-secondary d-block mt-3">Voltar para a lista de posts</a>
        </div>

        <form id="translationForm" action="{{ route('posts.translation.store', ['id' => $post->id_post]) }}" method="post" style="display: none; text-align: center;">
            @csrf
            <select name="id_language" class="form-select mb-3">
                @foreach($languages as $language)
                    <option value="{{ $language['id_language'] }}">{{ $language['language'] }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success btn-sm">Concluir Tradução</button>
        </form>
    @endauth
    
    <script>
        $(document).ready(function() {
            $("#translateButton").click(function() {
                $("#translationForm").toggle();
            });
        });
    </script>
    
@endsection
