<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //dd(Post::get());
        // $posts = Post::get();
        $posts = Post::orderBy('title', 'DESC')->paginate(2);
        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {

        //dd($request->all());
        // Post::create([
        //     'title' => $request->title,
        //     'content' => $request->content,
        // ]);

        $data = $request->all();

        if ($request->image->isValid()) {

            $nameFile = Str::of($request->title)->slug('-') . "." . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post Criado com sucesso');
    }

    public function show($id)
    {
        //dd($id);

        //$post = Post::where('id', $id)->first();
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        //dd($post);

        return view('admin.posts.show',  [
            'post' => $post,
        ]);
    }

    public function destroy($id)
    {
        //dd("Deletando o post {$id}");
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        if (Storage::exists($post->image)) {
            Storage::delete(($post->image));
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('message', 'Post Deletado com sucesso');
    }

    public function edit($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        //dd($post);

        return view('admin.posts.edit',  [
            'post' => $post,
        ]);
    }

    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image)) {
                Storage::delete(($post->image));
            }

            $nameFile = Str::of($request->title)->slug('-') . "." . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso');


        // dd("Editando o post: {$post->id}");
    }

    public function search(Request $request)
    {
        $filters = $request->except(['_token']);

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "%{$request->search}%")
            ->paginate(2);

        return view('admin.posts.index', [
            'posts' => $posts,
            'filters' => $filters,
        ]);
        //     ->toSql();
        // dd($posts);
        // dd("pesquisando por {$request->search}");
    }
}
