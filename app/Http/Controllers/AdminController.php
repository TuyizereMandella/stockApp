<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show login form
    public function showLogin()
    {
        // Prevent redirect loop if already logged in
        if (Auth::guard('admin')->check()) {
            return redirect('/items');
        }
        return view('auth.login');
    }

    // Handle login attempt
    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate using the admin guard
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/items')->with('success', 'Logged in successfully!');
        }

        // Return error if authentication fails
        return back()->withErrors(['msg' => 'Invalid username or password']);
    }

    // Show signup form
    public function showSignup()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/items');
        }
        return view('auth.signup');
    }

    // Handle signup process
    public function signup(Request $request)
    {
        // Validate signup form input
        $request->validate([
            'username' => 'required|unique:admins|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Create new admin with hashed password
        Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Admin account created!');
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}