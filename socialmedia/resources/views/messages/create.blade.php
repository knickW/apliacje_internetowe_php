@extends('layouts.app')

@section('content')
<h2>Create a New Message</h2>

<form method="post" action="{{ route('messages.store') }}">
    @csrf
    <div class="form-group">
        <label for="receiver_id">Receiver:</label>
        <select name="receiver_id" id="receiver_id">
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea>
    </div>
    <button type="submit">Send Message</button>
</form>
@endsection