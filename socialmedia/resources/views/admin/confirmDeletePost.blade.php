@extends('layouts.app')

@section('content')
<h2>Confirm Delete Post</h2>

<p>Are you sure you want to delete this post?</p>

<form method="post" action="{{ route('admin.posts.delete', $post) }}">
    @csrf
    @method('delete')
    <button type="submit">Yes, Delete</button>
    <a href="{{ route('admin.posts') }}">No, Cancel</a>
</form>
@endsection