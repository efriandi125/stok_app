<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request)
    {
 
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (auth()->attempt(request(['email', 'password']))) {
            
            return redirect()->route('Homes.index');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
