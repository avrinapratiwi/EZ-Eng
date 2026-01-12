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

        // Ambil attempt terakhir untuk module ini
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->where('module_id', $moduleId)
            ->latest()
            ->first();

        // Cegah akses jika belum lulus
        if (!$attempt || !$attempt->passed) {
            abort(403, 'You have not passed this course.');
        }

        $module = Module::findOrFail($moduleId);

        return view('certificate', [
            'user' => $user,
            'module' => $module,
            'attempt' => $attempt
        ]);
    }
}
