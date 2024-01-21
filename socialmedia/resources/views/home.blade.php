@extends('layouts.app')

@section('content')
<h2>Posts</h2>

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

@if ($posts !== null)
@forelse ($posts as $post)
<div class="card mt-3">
    <div class="card-header">
        <h3>{{ $post->title }}</h3>
        <p>Author: {{ $post->user->name }}</p>
    </div>
    <div class="card-body">
        <p>{{ $post->content }}</p>
        @if($post->media->count() > 0)
        <div class="row">
            @foreach($post->media as $media)
            <div class="col-md-4 mb-2">
                <img src="{{ url($media->path) }}" class="img-fluid" alt="Post Image">
            </div>
            @endforeach
        </div>
        @endif
        <p>Created at: {{ $post->created_at }}</p>
        <p>Likes: {{ $post->likes_count }}</p>
        <p>Dislikes: {{ $post->dislikes_count }}</p>
    </div>
    <div class="card-footer">
        <div>
            <strong>Likes: {{ $post->likes_count }}</strong>
            <div class="like-form" data-post-id="{{ $post->id }}">
                <button class="btn btn-primary like-btn">Like</button>
            </div>
        </div>

        <div>
            <strong>Dislikes: {{ $post->dislikes_count }}</strong>
            <div class="dislike-form" data-post-id="{{ $post->id }}">
                <button class="btn btn-danger dislike-btn">Dislike</button>
            </div>
        </div>
    </div>
</div>
@empty
<p>No posts available.</p>
@endforelse
@else
<p>No posts available.</p>
@endif

{{ $posts->links() }}
@endsection