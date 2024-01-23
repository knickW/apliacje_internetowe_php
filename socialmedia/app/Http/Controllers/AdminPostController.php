<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminPostController extends Controller
{
    public function managePosts()
    {
        $posts = Post::all();

        return view('admin.managePosts', compact('posts'));
    }

    public function editPost(Post $post)
    {
        return view('admin.editPost', compact('post'));
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully.');
    }
    public function updatePost(Post $post)
    {

    }
}
