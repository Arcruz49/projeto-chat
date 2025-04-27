<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use View;

class HomeController extends Controller
{
    public function Index(){
        $user = session()->get('user');
    
        if ($user) {

            return view('home.teste', compact('user'));
        }
    
        return redirect()->route('login')->with('error', 'Você precisa fazer login.');
    }
    
}
