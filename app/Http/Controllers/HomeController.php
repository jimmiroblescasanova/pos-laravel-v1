<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        return view('home');
    }

    public function readNotification($id)
    {
        $notification = DatabaseNotification::where('id', $id)->first();
        $notification->markAsRead();

        return redirect()->route('inventory.index', 's='.$notification->data['barcode']);
    }

    public function readAllNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }
}
