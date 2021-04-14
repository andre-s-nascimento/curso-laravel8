@if ($errors->any())
    <div class="class danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf
<input type=" text" name="title" id="title" placeholder="Título" value="{{ $post->title ?? old('title') }}">
<textarea name="content" id="content" cols="30" rows="4"
    placeholder="Conteudo">{{ $post->content ?? old('content') }}</textarea>
<button type="submit" class="btn btn-primary">Enviar</button>
