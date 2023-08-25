<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper; 

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
        if(Helper::CheckUserRole('superadmin')){
            return view('superadmin.home');
        }else if(Helper::CheckUserRole('admin')){
            return view('admin.home');
        }else if(Helper::CheckUserRole('user')){
            return view('user.home');
        }
    }
}
