<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //controller pour afficher tout les messages
    public function Message()
    {
        try {
            return view('message');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    //controller pour afficher une conversation
    public function Conversation($id)
    {
        try {
            return view('conversation');
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }


}
