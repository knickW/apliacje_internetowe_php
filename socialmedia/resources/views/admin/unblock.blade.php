@extends('layouts.app')

@section('content')
<h2>Unblock User</h2>
<form method="post" action="{{ route('admin.users.unblock', $user) }}">
    @csrf
    <button type="submit">Unblock User</button>
</form>
@endsection