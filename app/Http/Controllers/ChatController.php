<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * START CHAT (guest / masyarakat)
     */
    public function start(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
        ]);

        $userId = Auth::id();

        // 🔥 Ambil session terakhir user (bukan cuma open)
        $session = ChatSession::where('user_id', $userId)
            ->latest()
            ->first();

        // Kalau belum pernah chat sama sekali
        if (! $session) {
            $session = ChatSession::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'user_id' => $userId,
                'status' => 'open',
            ]);
        }

        return response()->json([
            'success' => true,
            'chat_session' => $session,
        ]);
    }

    /**
     * SEND MESSAGE
     */
    public function send(Request $request)
    {
        $request->validate([
            'chat_session_id' => 'required|exists:chat_sessions,id',
            'message' => 'required|string',
        ]);

        ChatMessage::create([
            'chat_session_id' => $request->chat_session_id,
            'user_id' => Auth::id(),
            'sender_type' => Auth::user()->level === 'admin' ? 'admin' : 'masyarakat',
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    public function messages($id)
    {
        $session = ChatSession::with('messages')->findOrFail($id);

        return response()->json([
            'success' => true,
            'messages' => $session->messages,
        ]);
    }

    public function getSession()
    {
        $userId = Auth::id();

        $session = ChatSession::where('user_id', $userId)
            ->latest()
            ->first();

        return response()->json([
            'success' => true,
            'chat_session' => $session,
        ]);
    }

    public function indexAdmin()
    {
        $sessions = ChatSession::latest()->get();

        return view('admin.chat.index', compact('sessions'));
    }

    public function showAdmin($id)
    {
        $session = ChatSession::with('messages')->findOrFail($id);

        return view('admin.chat.show', compact('session'));
    }

    public function replyAdmin(Request $request)
    {
        ChatMessage::create([
            'chat_session_id' => $request->chat_session_id,
            'user_id' => Auth::id(),
            'sender_type' => 'admin',
            'message' => $request->message,
        ]);

        return back();
    }

    public function close($id)
    {
        $session = ChatSession::findOrFail($id);

        $session->update([
            'status' => 'closed',
        ]);

        return back()->with('success', 'Chat berhasil ditutup');
    }
}
