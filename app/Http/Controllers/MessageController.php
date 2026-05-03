<?php
 
namespace App\Http\Controllers;
 
use App\Models\Message;
use Illuminate\Http\Request;
 
class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }
 
    public function show(Message $message)
    {
        $message->update(['is_read' => true]);
        return response()->json($message);
    }
 
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully!'
        ]);
    }
}
