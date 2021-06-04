<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    //
    public function index() 
    {
        $posts = Post::all();
        return view('post.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);
        Post::create([
            'name' => $request->name,
            'content' => $request->content
        ]);

        return redirect('/post');
    }

    public function create() 
    {
        return view('post.create');
    }

    public function edit(Request $request)
    {   
        return view('post.edit', ['post' => Post::find($request->id)]);
    }

    public function update(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::find($request->id);
        $post->name = $request->name;
        $post->content = $request->content;
        $post->save();

        return redirect('/post');
    }

    public function filter(Request $request)
    {
        $post = Post::where('name', 'like', '%'.$request->name.'%')
            ->where('content', 'like', '%'.$request->content.'%')
            ->get();
        $returnHTML = view('post.partial-post')->with('posts', $post)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
        return response($request->content);
        dd($request->name);
        # code...
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string',
        ]);

        $post = Post::find($request->id);
        $post->name = $request->name;
        $post->content = $request->content;
        $post->save();

        return redirect('/post');
    }

    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();

        return redirect('/post');
    }
}
