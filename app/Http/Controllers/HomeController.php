<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Participant;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset(Auth::user()->is_pref)) {
            // 県連認証済みなら一覧にリダイレクト
            $participants = Participant::where('pref', Auth::user()->is_pref)->where('category', '<>', '任意参加者')->paginate(100);
            return view('pref_participants.index')->with('participants', $participants);
        } else if(isset(Auth::user()->is_admin)) {
            $participants = Participant::where('name', '')->get();
            return view('home')->with('participants', $participants);
        } else {
            // それ以外はhomeへ
            return view('home');
        }
    }
}
