<h1>Detalhes do Post {{ $post->title }}</h1>
<ul>
    <li><strong>Título:</strong>{{ $post->title }}</li>
    <li><strong>Conteudo:</strong>{{ $post->content }}</li>
</ul>

<form action="{{ route('posts.destroy', $post->id) }}" method="post">
    @csrf
    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Deletar o post {{ $post->title }}</button>
</form>
