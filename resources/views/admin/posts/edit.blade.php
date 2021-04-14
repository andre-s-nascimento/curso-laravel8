<h1>
    Editar Post: <strong>{{ $post->title }}</strong>
</h1>

@if ($errors->any())
    <div class="class danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('put')
    <input type=" text" name="title" id="title" placeholder="Título" value="{{ $post->title }}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo">{{ $post->content }}</textarea>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
