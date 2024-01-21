@extends('layouts.app')

@section('content')
<h2>Block User</h2>
<form method="post" action="{{ route('admin.users.block', $user) }}">
    @csrf
    <button type="submit">Block User</button>
</form>
@endsection