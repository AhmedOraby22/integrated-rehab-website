<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login', [
            'signupEnabled' => config('admin.signup_enabled'),
        ]);
    }

    public function showRegister()
    {
        if (! config('admin.signup_enabled')) {
            abort(404);
        }

        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.register');
    }

    public function register(Request $request)
    {
        if (! config('admin.signup_enabled')) {
            abort(404);
        }

        $username = preg_replace('/\s+/', ' ', trim($request->input('username', '')));

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

        if (strlen($username) < 3 || strlen($username) > 60) {
            return back()
                ->withErrors(['username' => 'Username must be between 3 and 60 characters.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }

        if (User::where('username', $username)->exists()) {
            return back()
                ->withErrors(['username' => 'This username is already taken.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $username,
            'email' => $data['email'],
            'password' => $data['password'],
            'is_admin' => true,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Your admin account has been created.');
    }

    public function login(Request $request)
    {
        $login = preg_replace('/\s+/', ' ', trim($request->input('username', '')));

        if ($login === '') {
            return back()
                ->withErrors(['username' => 'Please enter your username or email.']);
        }

        $data = $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = User::where('is_admin', true)
            ->where(function ($query) use ($login) {
                $query->where('username', $login)
                    ->orWhere('email', $login);
            })
            ->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()
                ->withErrors(['username' => 'Invalid username/email or password.'])
                ->withInput(['username' => $login]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
