@extends('layout')

<title>Editar Post</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">Editar Post</h2>

        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('posts.update', ['id' => $post->id_post]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" value="{{ $post->titulo }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo:</label>
                <textarea name="conteudo" rows="4" class="form-control" required>{{ $post->conteudo }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Post</button>
        </form>

        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </div>
@endsection