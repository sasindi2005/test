<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registration function — paste your code here
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'rescue'; // auto-assign rescue role
        $user->save();

        return redirect('/login')->with('success','Registered!');
    }

    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login function — paste your code here
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $role = Auth::user()->role;
            if($role=='rescue') return redirect('/rescue/dashboard');
            // other roles here...
        }
        return back()->with('error','Invalid credentials');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

}
