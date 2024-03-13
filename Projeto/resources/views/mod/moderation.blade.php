@extends('layout')
<title>Detalhes do Post - {{ auth()->user()->name }}</title>
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
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
            <div class="card-footer text-muted d-flex justify-content-between">
                <small>Criado em: {{ $post->created_at }}</small>
                <div class="d-flex">
                    <form action="{{ route('posts.report', ['id' => $post->id_post]) }}" method="get" class="mb-3 me-3">
                        @csrf
                        <button type="submit" class="btn btn-warning">Denunciar</button>
                    </form>
                    <form action="{{ route('posts.delete', ['id' => $post->id_post]) }}" method="get" class="ml-3">
                        @csrf
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar para a lista de posts</a>
    </div>
@endsection
