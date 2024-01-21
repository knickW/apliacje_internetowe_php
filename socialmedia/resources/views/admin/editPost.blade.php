@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>

<form method="post" action="{{ route('admin.posts.update', $post) }}">
    @csrf
    @method('put')

    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
    </div>

    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required>{{ $post->content }}</textarea>
    </div>

    <!-- Dodaj inne pola do edycji, jeśli są potrzebne -->

    <button type="submit">Update Post</button>
</form>
@endsection
