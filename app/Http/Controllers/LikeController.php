<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use App\Events\LikeEvent;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt');
        //$this->middleware('auth:api', ['except' => ['login']]);
    }

    public function likeIt(Reply $reply){
        $reply->likes()->create([
            'user_id' => auth()->id(),
           // 'user_id' => 1,
        ]);
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }

    public function unlikeIt(Reply $reply){
        $reply->likes()->where('user_id',auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
        //$reply->likes()->where('user_id',1)->first()->delete();
    }
}
