<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showSignup()
    {
        // Cegah akses signup jika sudah login
        if (Session::has('user')) {
            $user = Session::get('user');

            return $user->role === 'admin'
                ? redirect('/dashboard-admin')
                : redirect('/dashboard-learner');
        }

        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:users',
            'email'      => 'required|email|unique:users',
            'phone'      => 'required|digits:13|unique:users,phone_number',
            'password'   => 'required|string|min:6',
            'gender'     => 'required|in:male,female',
            'address'    => 'required|string|max:255',
            'bio'        => 'nullable|string',
            'photo'      => 'nullable|image|mimes:png,jpg|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $token = Str::random(60);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'bio' => $request->bio,
            'photo' => $photoPath,
            'password' => Hash::make($request->password),
            'role' => 'learner',
            'status' => 'TIDAK AKTIF',
            'email_verification_token' => $token,
        ]);

        Mail::send('verifikasi', ['token' => $token], function($message) use ($user){
            $message->to($user->email);
            $message->subject('Verify Your Account');
        });

        return redirect()->back()->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function verify($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/login')->with('error', 'Invalid token.');
        }

        $user->status = 'AKTIF';
        $user->email_verification_token = null;
        $user->save();

        return redirect('/login')->with('success', 'Verification successful! Please log in.');
    }
    
    public function showLogin()
    {
        // Cegah akses login jika sudah login
        if (Session::has('user')) {
            $user = Session::get('user');

            return $user->role === 'admin'
                ? redirect('/dashboard-admin')
                : redirect('/dashboard-learner');
        }

        return view('login');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Cari user berdasarkan email
        $user = User::where('username', $request->username)->first();
    
        if (!$user) {
            return back()->with('error', 'Username not found!');
        }
    
        // Cek status akun
        if ($user->status != 'AKTIF') {
            return back()->with('error', 'Account is not active! Please verify your email first.');
        }
    
        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid password!');
        }
    
        // Simpan data user ke session
        Session::put('user', $user);
    
        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect('/dashboard-admin-data');
        } elseif ($user->role === 'learner') {
            return redirect('/dashboard-learner');
        } else {
            return back()->with('error', 'Unrecognized role. Please contact the administrator.');
        }
    }
    
    // Logout
    public function logout()
    {
        Session::forget('user');
        return redirect('/login')->with('success', 'Successfully logged out.');
    }


}
