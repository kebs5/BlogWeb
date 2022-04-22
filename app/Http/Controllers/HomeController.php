<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Crime;

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
        // $user_id = auth()->user()->id;
        // $user=User::find($user_id);
        // $posts = Crime::orderBy('created_at','desc')->get();
        // //$posts = Post::orderBy('title','desc')->get();
        // return view('dashboard')->with('posts', $posts);

        $posts = Crime::orderBy('created_at','desc')->paginate(3);
        return view('dashboard') ->with('posts', $posts);
        
    }
}
