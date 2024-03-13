@extends('layout')
<title>Reportar Post</title>
    @section('content')
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif   
    <div class="container mt-5">
        <h2 class="mb-4">Reportar Post</h2>

        <form action="{{ route('posts.report.post', ['id' => $post->id_post]) }}" method="post" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="reason" class="form-label">Motivo do Relatório:</label>
                <textarea name="reason" id="reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Relatório</button>
        </form>

        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para a lista de posts</a>
    </div>
@endsection
