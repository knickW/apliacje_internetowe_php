<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $receivedMessages = Message::where('receiver_id', $user->id)->get();
        $sentMessages = Message::where('sender_id', $user->id)->get();

        return view('messages.index', compact('receivedMessages', 'sentMessages'));
    }

    public function create()
    {
        // Pobierz listę użytkowników
        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }
}
