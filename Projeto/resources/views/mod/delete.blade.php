@extends('layout')
<title>Eliminar Post - MOD</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Eliminar Post - MOD</h2>

        <h3>Título: {{ $post->titulo }}</h3>
        <p>Conteúdo: {{ $post->conteudo }}</p>
        <p>Autor: {{ $post->user->name }}</p>
        <p>Criado em: {{ $post->created_at }}</p>

        <form action="{{ route('posts.delete.post', ['id' => $post->id_post]) }}" method="post" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="reason" class="form-label">Motivo da Eliminação:</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Post</button>
        </form>

        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para a lista de posts</a>
    </div>

@endsection
