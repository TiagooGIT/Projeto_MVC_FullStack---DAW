@extends('layout')
<title>HomePage</title>

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex align-items-center justify-content-center mb-1">
        <img src="{{ asset('images/AlienBlue_Icon.png') }}" alt="Reddit Logo" style="max-height: 80px;">
        <h2 class="text-center text-black ms-3 fw-bold">ForuEddit</h2>
    </div>


    @foreach($posts as $post)
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
                    <a href="{{ route('posts.show', ['id' => $post->id_post]) }}" class="btn btn-primary btn-sm me-2" style="max-height: 30px; min-width: 80px;">Ver mais</a>
                    @auth
                        @if(!auth()->user()->moderator)
                            @if(auth()->user()->id_user !== $post->user->id_user)
                                <form method="post" action="{{ route('posts.vote', ['id' => $post->id_post]) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" name="vote" value="up" class="btn btn-success btn-sm" style="max-height: 30px; min-width: 80px;" >Upvote</button>
                                    <button type="submit" name="vote" value="down" class="btn btn-danger btn-sm" style="max-height: 30px; min-width: 80px;" >Downvote</button>
                                </form>
                            @endif

                            @if(auth()->user()->id_user === $post->user->id_user)
                                <a href="{{ route('posts.edit', ['id' => $post->id_post]) }}" class="btn btn-warning btn-sm" >Atualizar Post</a>
                            @endif
                        @endif
                   
                        @if(auth()->user()->moderator)
                            <a href="{{ route('posts.moderation', ['id' => $post->id_post]) }}" class="btn btn-info btn-sm" style="max-height: 30px; min-width: 80px;">Moderar</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @endforeach

    @if(auth()->check() && !auth()->user()->moderator)
        <div class="text-end mt-5 mb-5">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Criar Post</a>
        </div>
    @endif
@endsection
