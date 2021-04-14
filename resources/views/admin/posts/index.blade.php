@extends('admin.layouts.app')

@section('title', 'Listagem dos Posts')

@section('content')
    <a href="{{ route('posts.create') }}">Criar Novo Post</a>
    <hr>
    @if (session('message'))
        <div class="success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Filtrar">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <h1>Posts</h1>

    @foreach ($posts as $post)
        <div class="container">
            <p> {{ $post->title }} -
                [
                <a href="{{ route('posts.show', $post->id) }}">Ver</a>
                | <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
                ]
            </p>
        </div>
    @endforeach
    <hr>
    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif

@endsection
