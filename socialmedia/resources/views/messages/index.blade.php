@extends('layouts.app')

@section('content')
<h2>Received Messages</h2>

@foreach ($receivedMessages as $message)
<div>
    <p>From: {{ $message->sender->name }}</p>
    <p>{{ $message->content }}</p>
    <p>Sent at: {{ $message->created_at }}</p>
</div>
@endforeach

<h2>Sent Messages</h2>

@foreach ($sentMessages as $message)
<div>
    <p>To: {{ $message->receiver->name }}</p>
    <p>{{ $message->content }}</p>
    <p>Sent at: {{ $message->created_at }}</p>
</div>
@endforeach
@endsection