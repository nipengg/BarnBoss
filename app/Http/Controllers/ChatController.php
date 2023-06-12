<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($id)
    {
        $chats = Chat::where("invoice_id", $id)->get();

        return view("chat.index", [
            'chats' => $chats,
            'invoice' => $id,
        ]);
    }

    public function indexSeller()
    {
        $chats = Chat::where('seller_id', Auth::user()->id)->get();

        return view('chat.indexSeller', [
            'chats' => $chats
        ]);
    }

    public function room($id)
    {
        $chat = Chat::where('id', $id)->firstOrFail();
        $messages = Message::where('chat_id', $id)->get();
        
        return view("chat.chat", [
            'chat' => $chat,
            'messages' => $messages
        ]);
    }

    public function send(Request $request, $id)
    {
        $data = $request->all();

        Message::create([
            'chat_id' => $id,
            'sender_id' => Auth::user()->id,
            'messages' => $data['messages'],
        ]);

        return redirect()->action([ChatController::class, 'room'], ['id' => $id]);
    }
}
