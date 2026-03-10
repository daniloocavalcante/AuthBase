<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Cache;


class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){        
        $user = Auth::user();
        return view('dashboard.home', compact('user'));
   }

    public function profile(){        
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    public function showChangePasswordForm(){        
        $user = Auth::user();
        return view('dashboard.change_password', compact('user'));
    }

    public function changePassword(){
        //POST
    }

    public function users(){  
        return view('dashboard.users');
    }
}

