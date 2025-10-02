<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Read: list all posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // CREATE: show form
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // CREATE: save to DB
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        return redireact()->route('posts.index')
                        ->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     */
    // READ: single post
    public function show(string $id)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // UPDATE: show edit form
    public function edit(string $id)
    {
        return view('posts.edit', compact('post');)
    }

    /**
     * Update the specified resource in storage.
     */
    // UPDATE: save changes
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($data);

        return redirect()->route('posts.index')
                        ->with('status', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE
    public function destroy(string $id)
    {
        $post->delete();
        return redirect()->route('posts.index')
                        ->with('status', 'Post deleted!');
    }
}
