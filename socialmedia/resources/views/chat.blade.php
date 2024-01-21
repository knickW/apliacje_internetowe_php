@extends('layouts.app')

@section('content')
<div>
    <h2>Czat</h2>

    <div id="chat-container" class="chat-container">
        @forelse ($messages as $message)
        <div>
            <p>{{ $message->sender->name }} to {{ $message->receiver->name }}:</p>
            <p>{{ $message->content }}</p>
        </div>
        @empty
        <p>Brak wiadomości.</p>
        @endforelse
    </div>

    <form method="post" action="{{ route('chat.send') }}" id="message-form">
        @csrf
        <div>
            <label for="content">Treść wiadomości:</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        <div>
            <label for="receiver_id">Odbiorca:</label>
            <select name="receiver_id" id="receiver_id" required>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Wyślij</button>
    </form>
</div>

@section('scripts')
<script>
    Echo.private(`private-chat.{{ auth()->id() }}`)
        .listen('NewMessage', (event) => {
            console.log('New message received!', event);

            const chatContainer = document.getElementById('chat-container');
            const messageDiv = document.createElement('div');
            messageDiv.innerHTML = `
                        <p>${event.message.sender.name} to ${event.message.receiver.name}:</p>
                        <p>${event.message.content}</p>
                    `;
            chatContainer.appendChild(messageDiv);

            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
</script>
@endsection
@endsection