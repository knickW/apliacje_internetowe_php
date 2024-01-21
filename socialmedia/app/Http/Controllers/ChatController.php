<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Events\NewMessage;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        $users = User::where('id', '!=', $user->id)->get();

        return view('chat', compact('messages', 'users'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $user = Auth::user();
        $message = new Message([
            'content' => $request->content,
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
        ]);
        $message->save();

        broadcast(new NewMessage($message))->toOthers();

        return redirect()->route('chat')->with('success', 'Wiadomość wysłana pomyślnie.');
    }

    public function getUsers()
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('chat', compact('users'));
    }
}
