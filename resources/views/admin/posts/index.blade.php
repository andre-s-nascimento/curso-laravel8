<a href="{{ route('posts.create') }}">Criar Novo Post</a>
<hr>
@if (session('message'))
    <div class="success">
        {{ session('message') }}
    </div>
@endif

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
