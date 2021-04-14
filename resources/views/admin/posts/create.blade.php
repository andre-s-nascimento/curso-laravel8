<h1>
    Cadastrar Novo Post
</h1>

@if ($errors->any())
<div class="class danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Título" value="{{old('title')}}">
    <textarea name="content" id="content" cols="30" rows="4" placeholder="Conteudo">{{old('content')}}</textarea>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>