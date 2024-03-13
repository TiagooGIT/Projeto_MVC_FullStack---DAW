@extends('layout')
    <title>Post Traduzido</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container mt-5">
        <h2>Detalhes do Post</h2>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Título: {{ $postTranslated->titulo }}</h3>
                <p class="card-text">Conteúdo: {{ $postTranslated->conteudo }}</p>
                <p class="card-text">Autor: {{ $postTranslated->user->name }}</p>
                <p class="card-text">Língua Traduzida: {{ $postTranslated->language->language }}</p>
                <p class="card-text">Criado em: {{ $postTranslated->created_at }}</p>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
    </div>

@endsection
