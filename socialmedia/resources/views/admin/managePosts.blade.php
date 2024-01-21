@extends('layouts.app')

@section('content')
<h2>Manage Posts</h2>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->user->name }}</td>
            <td>
                <a href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                <a href="{{ route('admin.posts.confirmDelete', $post) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection