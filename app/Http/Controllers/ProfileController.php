<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        // Cek apakah user login
        $user = Session::get('user');

        if (!$user) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        // Validasi sesuai struktur tabel
        $request->validate([
            'photo'        => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|digits_between:10,13|unique:users,phone_number,' . $user->id,
            'gender'       => 'required|in:male,female',
            'address'      => 'required|string|max:255',
            'bio'          => 'nullable|string',
        ]);

        // Ambil user dari database
        $dbUser = User::find($user->id);

        // Jika user ingin menghapus foto
        if ($request->has('delete_photo') && $request->delete_photo == 1) {
            if ($dbUser->photo && file_exists(public_path('storage/photos/' . $dbUser->photo))) {
                unlink(public_path('storage/photos/' . $dbUser->photo));
            }
            $dbUser->photo = null; // set kolom foto menjadi null
        }

        // Jika upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($dbUser->photo && file_exists(public_path('storage/photos/' . $dbUser->photo))) {
                unlink(public_path('storage/photos/' . $dbUser->photo));
            }

            // Ambil file
            $file = $request->file('photo');
            // Buat nama unik
            $filename = time() . '_' . $file->getClientOriginalName();
            // Pindahkan ke public/storage/photos
            $file->move(public_path('storage/photos'), $filename);

            // Simpan nama file ke DB
            $dbUser->photo = $filename;
        }

        // Update informasi user
        $dbUser->first_name   = $request->first_name;
        $dbUser->last_name    = $request->last_name;
        $dbUser->username     = $request->username;
        $dbUser->email        = $request->email;
        $dbUser->phone_number = $request->phone_number;
        $dbUser->gender       = $request->gender;
        $dbUser->address      = $request->address;
        $dbUser->bio          = $request->bio;

        // Simpan ke DB
        $dbUser->save();

        // Update session supaya dashboard ikut berubah
        Session::put('user', $dbUser);

        return back()->with('success', 'Profile updated successfully!');
    }
}
