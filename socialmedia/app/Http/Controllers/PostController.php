<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function indexForLikedByUser()
    {
        $user = Auth::user();
        $likedPosts = $user->likedPosts()->latest()->paginate(10);

        return view('posts.indexLiked', compact('likedPosts'));
    }

    public function indexForCurrentUser()
    {
        $user = Auth::user();
        $userPosts = $user->posts()->latest()->paginate(10);

        return view('posts.index', compact('userPosts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);
        $post->save();

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $post->addMedia($image)->toMediaCollection('images', 'public/media');
            }
        }

        return redirect()->route('user.posts')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function like(Post $post)
    {
        $post->likes_count++;
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Polubiono post.');
    }

    public function dislike(Post $post)
    {
        $post->dislikes_count++;
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Niepolubiono posta.');
    }
}
