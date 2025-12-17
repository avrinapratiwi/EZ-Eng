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
        $user = Session::get('user');
        if (!$user) {
            return redirect('/login')->with('error', 'Please login first.');
        }

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

        $dbUser = User::findOrFail($user->id);

        /**
         * Paksa ke ROOT public_html, bukan public_html/public
         * - base_path() biasanya mengarah ke folder project (mis: /home/u123/laravel)
         * - dirname(base_path()) naik 1 folder (mis: /home/u123)
         * - lalu masuk ke public_html
         */
        $publicHtml = dirname(base_path()) . '/public_html';
        $uploadPath = $publicHtml . '/storage/photos';

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        if (!is_writable($uploadPath)) {
            return back()->with('error', 'Folder upload tidak writable: ' . $uploadPath);
        }

        // Hapus foto (checkbox)
        if ($request->boolean('delete_photo')) {
            if ($dbUser->photo) {
                $oldFile = $publicHtml . '/' . ltrim($dbUser->photo, '/'); // storage/photos/xxx.jpg
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }
            $dbUser->photo = null;
        }

        // Upload foto baru
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            if (!$file->isValid()) {
                return back()->with('error', 'Upload file gagal (file tidak valid).');
            }

            // Hapus foto lama
            if ($dbUser->photo) {
                $oldFile = $publicHtml . '/' . ltrim($dbUser->photo, '/');
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            // simpan path relatif untuk URL: https://domain.com/storage/photos/xxx.jpg
            $dbUser->photo = 'storage/photos/' . $fileName;
        }

        // Update data user
        $dbUser->first_name   = $request->first_name;
        $dbUser->last_name    = $request->last_name;
        $dbUser->username     = $request->username;
        $dbUser->email        = $request->email;
        $dbUser->phone_number = $request->phone_number;
        $dbUser->gender       = $request->gender;
        $dbUser->address      = $request->address;
        $dbUser->bio          = $request->bio;

        $dbUser->save();
        Session::put('user', $dbUser);

        return back()->with('success', 'Profile updated successfully!');
    }
}