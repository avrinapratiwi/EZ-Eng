<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\QuizAttempt;

class ReviewController extends Controller
{
    public function certificate($moduleId)
    {
        $user = Session::get('user');

        // Ambil module (untuk nama kelas di sertifikat)
        $module = Module::findOrFail($moduleId);

        // Ambil attempt terakhir user (kalau ada, tapi tidak dipakai untuk validasi)
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->latest()
            ->first();

        // Langsung tampilkan sertifikat
        return view('certificate', [
            'user' => $user,
            'module' => $module,
            'attempt' => $attempt
        ]);
    }
}
