<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendChat(Request $request, $receiverId)
    {

        $senderId = Auth::user();

        $rules = [
            'message' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $userSendChat = Chat::create([
            "sender_id" => $senderId->id,
            "receiver_id" => $receiverId,
            "message" => $request->get('message')
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $userSendChat
        ]);
    }

    public function getMessage()
    {
        $user = Auth::user();
        $message = Chat::with('sender:id,name')->where('sender_id', $user->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }

    public function replyChat(Request $request, $receiverId)
    {
        $senderId = Auth::user();

        $rules = [
            'message' => 'required|string',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $userSendChat = Chat::create([
            "sender_id" => $senderId->id,
            "receiver_id" => $receiverId,
            "message" => $request->get('message')
        ]);

        $message = Chat::where('receiver_id', $senderId->id);
        $message->update([
            "status_read" => 1,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $userSendChat
        ]);
    }

    public function getMeesageDetail($sender_id)
    {
        $user = Auth::user();
        $message = Chat::with('sender:id,name')->where('sender_id', $sender_id)->where('receiver_id', $user->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }


    public function getLastMessage($sender_id)
    {
        $user = Auth::user();
        $message = Chat::with('sender:id,name')->where('sender_id', $sender_id)->where('receiver_id', $user->id)->latest('created_at')->first();

        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }


    public function countMessage($sender_id)
    {
        $user = Auth::user();
        $message = Chat::with('sender:id,name')->where('sender_id', $sender_id)->where('receiver_id', $user->id)->where('status_read', 0)->count();

        return response()->json([
            'status' => 'success',
            'data' => $message
        ]);
    }
}
