<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\GeneralChatEvent;
use App\Message;

class ChatController extends Controller
{
    public function general()
    {
      $hash = md5(strtolower(trim(auth()->user()->email)));
      $gravatar = "https://www.gravatar.com/avatar/$hash";
      return view('chat.general', compact('gravatar'));
    }

    public function get_general()
    {
      $message = Message::get();
      return response()->json($message);
    }

    public function send_general(Request $req)
    {
      $message = new Message;
      $message->user_id = $req->user_id;
      $message->user_name = $req->user;
      $message->message = $req->message;
      $message->date = $req->sdate;
      $message->avatar = $req->avatar;
      $message->isCoalesce = $req->isCoalesce;
      $message->isBreakWord = $req->isBreakWord;
      $message->save();

      broadcast(new GeneralChatEvent($req->all()))->toOthers();
      return $req;
    }

    public function private()
    {
      return view('chat.private');
    }

    public function team()
    {
      return view('chat.team');
    }
}
