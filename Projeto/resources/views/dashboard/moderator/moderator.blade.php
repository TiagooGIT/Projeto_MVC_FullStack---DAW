@extends('layout')

<title>Dashboard do Moderador</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container mt-5">
        <h2>Dashboard do Moderador</h2>

        <h3>Posts Eliminados</h3>
        @foreach($deletedPosts as $deletedPost)
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Titulo: {{ $deletedPost->title }}</h3>
                <p class="card-text">Conteudo: {{ $deletedPost->content }}</p>
                <p class="card-text">Post ID: {{ $deletedPost->id_user }}</p>
                <p class="card-text">Razão: {{ $deletedPost->reason }}</p>
                <p class="card-text">Eliminado Por: {{ $deletedPost->moderator->name }}</p>
                <small class="text-muted">Criado em: {{ $deletedPost->created_at }}</small>
            </div>
        </div>
        @endforeach

        <a href="{{ route('moderator.reports') }}" class="btn btn-primary">Ver Posts Reportados</a><br>
        <a href="{{ route('home') }}" class="btn btn-secondary mt-2">Voltar para a Home Page</a>
    </div>

@endsection

