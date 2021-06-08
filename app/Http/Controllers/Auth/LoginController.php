<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
      return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
      $credentials = $request->only('email', 'password');

      if (Auth::attempt($credentials)) {
          session(['users_auth' => $credentials]);
          return redirect()->intended('home');
      }

      return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
      Auth::logout();
      session()->forget('users_auth');
      return redirect('login');
    }

    public function home()
    {
      return view('auth.home');
    }
}
