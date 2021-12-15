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
}
