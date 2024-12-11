<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Attempt to log the user in without "remember me"
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], false)) {
            // Redirect to intended or home page after successful login
            return redirect()->intended('/dashboard');
        }

        // If login fails, redirect back with an error message
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    }


}
