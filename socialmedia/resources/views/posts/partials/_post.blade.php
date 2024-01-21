@extends('layouts.app')

@section('content')
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
            <form class="like-form" data-post-id="{{ $post->id }}">
                @csrf
                <button type="button" class="btn btn-primary like-btn">Like</button>
            </form>
        </div>

        <div>
            <strong>Dislikes: {{ $post->dislikes_count }}</strong>
            <form class="dislike-form" data-post-id="{{ $post->id }}">
                @csrf
                <button type="button" class="btn btn-danger dislike-btn">Dislike</button>
            </form>
        </div>
    </div>
</div>
@endsection