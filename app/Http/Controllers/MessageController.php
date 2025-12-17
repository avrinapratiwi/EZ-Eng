<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect('/login');
        }

        // 🔥 AMBIL SEMUA PESAN (GROUP CHAT)
        $messages = Message::with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // grouping tanggal
        $groupedMessages = $messages->groupBy(function ($msg) {
            return $msg->created_at->format('d M, Y');
        });

        return view('message-learner', compact('user', 'groupedMessages'));
    }

    public function sendMessage(Request $request)
    {
        $user = Session::get('user');
        if (!$user) {
            return response()->json(['status' => 'error'], 401);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'created_at' => $message->created_at->toIso8601String(),
                'user_id' => $user->id,
            ],
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name,
                'photo'      => $user->photo
                    ? asset('storage/'.$user->photo)
                    : asset('images/user.png'),
            ],
        ]);        
    }
}

