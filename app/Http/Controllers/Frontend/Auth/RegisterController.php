<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerStoreRequest;

class RegisterController extends Controller
{
    public function registerPage(){
        return view('frontend.pages.auth.register');
    }

    public function registerStore(CustomerStoreRequest $request){

        // dd($request->all());

         // user create
         User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'phone' =>$request->phone,
            'password'=>Hash::make($request->password)
        ]);

        // make credentials array

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //login attempt if success then redirect home

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('customer.dashboard');
        }


    }

    public function loginPage(){
        return view('frontend.pages.auth.login');
    }

    public function loginStore(Request $request){
        $validated = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|string|min:4',
           ]);

             $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            //login attempt if success then redirect home

            if(Auth::attempt($credentials,$request->filled('remember'))){
                $request->session()->regenerate();
                return redirect()->intended('customer/dashboard');
            }

             // Return with error message

            return back()->withErrors([
                'email' => 'Wrong Credentials Email'
            ])->onlyInput('email');

    }

    public function customerLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('login.page');
    }
}
