<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;

class ConversationsController extends Controller
{
    public function GetConversations(Request $req)
    {
        $conversation=Chat::newQuery()
                    ->whereRaw("((from_id = ".Auth::user()->id." AND to_id = $req->id) OR (from_id = $req->id AND to_id =".Auth::user()->id." ))")
                    ->orderBy('created_at','DESC');
        return $conversation;
    }
}
