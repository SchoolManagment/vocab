<?php

namespace App\Http\Controllers;

use App\Models\Ask;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $results = Ask::where('user_id', auth()->id())->with('book')->limit(10)->paginate(15);
        return view('home', compact('results'));
    }
}
