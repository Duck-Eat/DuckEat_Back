<?php

namespace App\Http\Controllers;

use App\Models\ChatBot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function index(Request $request) : JsonResponse
    {
        $answer = ChatBot::where('question',$request->question)->get();
        return response()->json(
            $answer
        );
    }
}
