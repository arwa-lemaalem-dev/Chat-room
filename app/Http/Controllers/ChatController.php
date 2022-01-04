<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Events\ChatEvent;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chat()
    {
        $chat=Chat::all();
        return view ('chat',['chats'=>$chat]);
    }

    public function sendMsg(Request $request)
    {
        $chat=Chat::create([
            'content'=>$request->message,
            'from_id'=>Auth::user()->id,
            'to_id'=>$request->user,
            'offre'=>$request->offre
        ]);
        $user=User::where('id',$request->user)->first();
        event(new ChatEvent($request->message,Auth::user(),$user,$request->offre,$chat->id));
        return $chat->id;
    }

    public function pdf(Request $request)
    {
        $data=$chat=Chat::where('id',$request->id)->first();
        $output="<title>Offre</title>
                 <h4 style='float:right'>Arwa Lemaalem</h4>
                 <br><br>
                 <h2>Offre</h2>
                 <p>".$data->content."</p>";
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();
    }

    public function listUser()
    {
        $users=User::where('id','!=',Auth::user()->id)->get();
        return view ('HOME',['users'=>$users]);
    }

    public function GetConversation()
    {
        $chats=DB::table('chats')->where([
           ['to_id', '=',Request('id') ],
           ['from_id', '=', Auth::user()->id],
        ])
        ->orWhere([
           ['to_id', '=', Auth::user()->id],
           ['from_id', '=', Request('id')],
        ])
        ->get();
        $user=User::where('id',Request('id'))->first();
        return view('Conversation',['chats'=>$chats,'avatar'=>$user->avatar,'name'=>$user->name]);
    }
}