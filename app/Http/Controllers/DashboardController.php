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

    public function edit(){        
        $user = Auth::user();
        return view('dashboard.edit', compact('user'));
    }

    public function update(){        
        //PUT

    }

    public function showChangePasswordForm(){        
        $user = Auth::user();
        return view('dashboard.change_password', compact('user'));
    }

    public function changePassword(){
        //POST
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        // opcional: deslogar antes de deletar
        Auth::logout();

        // deletar usuário
        $user->delete();

        // redirecionar para a página inicial com mensagem
        return redirect('/')->with('warning', 'Conta excluída com sucesso.');
    }

    public function users(){  
        return view('dashboard.users');
    }
}

