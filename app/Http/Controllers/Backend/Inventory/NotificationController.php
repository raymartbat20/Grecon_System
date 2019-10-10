<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        foreach(Auth::user()->unreadnotifications as $notification)
        {
            $notification->markAsRead();
        }
        return back();
    }
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        $notification->markAsRead();
        $count = Auth::user()->unreadnotifications()->count();
        
        return redirect($notification->data['link']);
    }
}
