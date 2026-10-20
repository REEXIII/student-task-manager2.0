<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'username' => [
                'required',
                'string',
                'min:4',
                'max:50',
                'unique:users,username',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create($data);

        return redirect()->route('login')->with(
            'success',
            'Registration successful. You may now log in.'
        );
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string'],
        ]);

        $authenticated = Auth::attempt([
            'password' => $data['password'],

            function (Builder $query) use ($data) {
                $query->where(function (Builder $query) use ($data) {
                    $query->where('username', $data['login'])
                        ->orWhere('email', $data['login']);
                });
            },
        ]);

        if ($authenticated) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()
            ->withErrors([
                'login' => 'Invalid username/email or password.',
            ])
            ->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
