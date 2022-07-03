<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'remember' => ['nullable', 'boolean']
        ]);

        if (Auth::attempt($request->only(['email', 'password']), $request->post('remember', false)) == false) {
            return back()->with('error', __('User not found'));
        }

        return redirect()->route('home');
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        $user = User::create(array_merge($request->only(['name', 'email']), [
            'password' => Hash::make($request->post('password')),
        ]));

        Auth::loginUsingId($user->id);

        return redirect()->route('home');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
