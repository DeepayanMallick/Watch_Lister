<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lists;
use App\Share;
use App\User;

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
        //Home page
        $user_id = auth()->user()->id;
       
        $mylists = Lists::where('privacy_id',2)->get();
        $shares = Share::where('user_id',$user_id)->get();

        return view('home', compact('mylists', 'shares'));
    }

    public function homeShow($id)
    {      
        //List View Page for home page
        
        $list = Lists::find($id);        
        $users = User::all();
        if (!isset($list)){
            return redirect('/')->with('error', 'No List Found');
        }
 
        return view('homeShow', compact('list', 'users'));
    }

}
