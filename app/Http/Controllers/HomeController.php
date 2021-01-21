<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        // return view('home');
        $Role= Auth::user()->role()->pluck('title');
        if( $Role->contains('admain'))
        {
            return redirect('/users');
        }
        elseif($Role->contains('user')){
            return redirect('my-tasks');

        }
        elseif($Role->contains('manager')){
            return redirect('my-tasks');

        }
        elseif($Role->contains('exc')){
            return redirect('my-tasks');

        }
        else{
            // abort(403);
            return redirect('/');
        }

        

    }
}
