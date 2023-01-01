<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginPage(){
        return view('backend.pages.auth.login');
    }


    public function login(Request $request){

        //  dd($request);
        $validated = $request->validate([
        'email' => 'required|max:255',
        'password' => 'required|string|min:4',
       ]);

         $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //login attempt if success then redirect home

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        // Return with error message

        return back()->withErrors([
            'email' => 'Wrong Credentials Email'
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
