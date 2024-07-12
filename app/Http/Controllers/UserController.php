<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegister() {
        return view('register');
    }

    public function register(Request $req) {

        $req->validate([
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password
        ]);

        return redirect()->route('login')->with('success','Registration Successfull Please Login');
    
    }

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt($data)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error','Email Or password is wrong');
    } 

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
