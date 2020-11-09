<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
        //$this->middleware('auth:api', ['except' => ['login']]);
    }
    
    public function index(){
        return [        
            'read' => NotificationResource::collection(auth()->user()->readNotifications),
            'unread' => NotificationResource::collection(auth()->user()->unreadNotifications)        
        ]; 
    }

    public function markAsRead(Request $request){
        auth()->user()->notifications->where('id',$request->id)->markAsRead();
    }
}
