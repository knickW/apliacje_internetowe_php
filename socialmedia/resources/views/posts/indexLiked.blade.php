@extends('layouts.app')

@section('content')
<h2>User's liked Posts</h2>

@if ($likedPosts !== null)
@forelse ($likedPosts as $post)
<div class="card mt-3">
    <div class="card-header">
        <h3>{{ $post->title }}</h3>
        <p>Author: {{ $post->user->name }}</p>
    </div>
    <div class="card-body">
        <p>{{ $post->content }}</p>
        <p>Created at: {{ $post->created_at }}</p>
        <p>Likes: {{ $post->likes_count }}</p>
        <p>Dislikes: {{ $post->dislikes_count }}</p>
    </div>
    <div class="card-footer">
        <div>
            <strong>Likes: {{ $post->likes_count }}</strong>
            <form method="post" action="{{ route('posts.like', $post) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Like</button>
            </form>
        </div>

        <div>
            <strong>Dislikes: {{ $post->dislikes_count }}</strong>
            <form method="post" action="{{ route('posts.dislike', $post) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Dislike</button>
            </form>
        </div>
    </div>
</div>
@empty
<p>No liked posts available.</p>
@endforelse
@else
<p>No liked posts available.</p>
@endif

{{ $likedPosts->links() }}

<div class="mt-3">
    <form method="get" action="{{ route('home') }}">
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort">
            <option value="created_at" {{ request('sort')=='created_at' ? 'selected' : '' }}>Date</option>
            <option value="likes_ratio" {{ request('sort')=='likes_ratio' ? 'selected' : '' }}>Likes Ratio</option>
        </select>

        <label for="order">Order:</label>
        <select name="order" id="order">
            <option value="desc" {{ request('order')=='desc' ? 'selected' : '' }}>Descending</option>
            <option value="asc" {{ request('order')=='asc' ? 'selected' : '' }}>Ascending</option>
        </select>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
</div>
@endsection