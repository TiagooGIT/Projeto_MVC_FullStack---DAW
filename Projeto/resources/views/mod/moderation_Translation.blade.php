@extends('layout')
<title>Moderar Post</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Moderar Post</h2>
        <hr>

        @if($posts_translated->isEmpty())
            <p>Não existe traduções para validar.</p>
        @else
            @foreach ($posts_translated as $translatedPost)
                @if ($translatedPost->validacao != 1)
                    <div class="border p-3 mb-3">
                        <p class="mb-2">Title: {{ $translatedPost->titulo }}</p>
                        <p class="mb-2">Content: {{ $translatedPost->conteudo }}</p>
                        <p class="mb-2">Author: {{ $translatedPost->user->name }}</p>
                        <p class="mb-2">Created at: {{ $translatedPost->created_at }}</p>
                        <p class="mb-2">Lingua Traduzida: {{ $translatedPost->language->language }}</p>

                        <form action="{{ route('posts.validateById', ['id' => $translatedPost->id_post]) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-success">Validar</button>
                        </form>
                        <hr>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>

@endsection
