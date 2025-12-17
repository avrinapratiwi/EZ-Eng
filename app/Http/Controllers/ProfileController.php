<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

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

        // Folder tujuan: public_html/storage/photos (secara Laravel: public/storage/photos)
        $uploadPath = public_path('storage/photos');

        // Pastikan folder ada
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // ======================
        // HAPUS FOTO (jika user centang delete)
        // ======================
        if ($request->has('delete_photo') && (int) $request->delete_photo === 1) {
            if ($dbUser->photo && File::exists(public_path($dbUser->photo))) {
                File::delete(public_path($dbUser->photo));
            }
            $dbUser->photo = null; // set kolom foto menjadi null
        }

        // ======================
        // UPLOAD FOTO BARU
        // ======================
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($dbUser->photo && File::exists(public_path($dbUser->photo))) {
                File::delete(public_path($dbUser->photo));
            }

            $file = $request->file('photo');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pindahkan langsung ke public/storage/photos (di hosting: public_html/storage/photos)
            $file->move($uploadPath, $fileName);

            // Simpan path RELATIF agar bisa dipanggil: asset($user->photo)
            $dbUser->photo = 'storage/photos/' . $fileName;
        }

        // ======================
        // Update informasi user
        // ======================
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