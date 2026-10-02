<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageAdminController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        $unreadCount = Message::where('is_read', false)->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show(Message $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email,
                'message' => $message->message,
                'created_at' => $message->created_at->format('d M Y, H:i'),
                'is_read' => $message->is_read,
            ]
        ]);
    }

    public function markAsRead(Message $message)
    {
        $message->update(['is_read' => true]);
        return redirect()->route('admin.messages.index')->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
