@extends('layout')

<title>Criar Post</title>
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="container mt-5">
        <h2 class="mb-4">Criar Post</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('posts.store') }}" method="post" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="conteudo" class="form-label">Conteúdo:</label>
                <textarea name="conteudo" rows="4" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="id_language" class="form-label">Idioma:</label>
                <select name="id_language" class="form-select">
                    @foreach($languages as $language)
                        <option value="{{ $language['id_language'] }}">{{ $language['language'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Criar Post</button>
        </form>
    </div>

@endsection