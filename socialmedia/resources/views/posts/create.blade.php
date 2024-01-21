@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Post</h2>
    <form method="post" action="{{ route('user.posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="images">Images (optional):</label>
            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection