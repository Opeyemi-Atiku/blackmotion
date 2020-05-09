<?php

namespace App\Http\Controllers;
use App\Question;

use Illuminate\Http\Request;

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
        $questions = Question::where('user_id', Auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10); 
        return view('home', compact('questions'));
    }
}