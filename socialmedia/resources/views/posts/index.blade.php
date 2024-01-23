@extends('layouts.app')

@section('content')
<h2>Your Posts</h2>

@if ($userPosts !== null)
@forelse ($userPosts as $post)
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

<div class="mt-3">
    {{ $userPosts->links() }}
</div>
@else
<p>No posts available.</p>
@endif

<!-- Przyciski z controllera -->
<div class="d-flex justify-content-end">
    <!-- Dodaj swoje przyciski z kontrolera tutaj -->
</div>
@endsection