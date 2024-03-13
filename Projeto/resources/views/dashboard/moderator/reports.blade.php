@extends('layout')

    <title>Posts Reportados</title>
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container mt-5">
        <h2>Posts Reportados</h2>

        @foreach($reportedPosts as $reportedPost)
        <div class="card mb-4">
            <div class="card-body">
                <!-- Exiba informações sobre os posts reportados -->
                <h3 class="card-title">Titulo: {{ $reportedPost->post->titulo }}</h3>
                <p class="card-text">Conteudo: {{ $reportedPost->post->conteudo }}</p>
                <p class="card-text">Post ID: {{ $reportedPost->post->id_post }}</p>
                <p class="card-text">Reason: {{ $reportedPost->reason }}</p>
                <small class="text-muted">Criado em: {{ $reportedPost->created_at }}</small>
                <!-- Adicione outras informações que deseja exibir -->
            </div>
        </div>
        @endforeach

        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar para a Home Page</a><br>
        <a href="{{ route('moderator.dashboard') }}" class="btn btn-primary mt-2">Ver Posts Eliminados</a><br>
    </div>
    
@endsection

