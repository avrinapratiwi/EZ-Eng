<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\QuizAttempt;
use Barryvdh\DomPDF\PDF;

class ReviewController extends Controller
{
    public function certificate($moduleId)
    {
        $user = Session::get('user');
        $module = Module::findOrFail($moduleId);

        $attempt = QuizAttempt::where('user_id', $user->id)->latest()->first();

        return view('certificate', compact('user','module','attempt'));
    }

    public function downloadCertificate(PDF $pdf, $moduleId)
    {
        $user = Session::get('user');
        $module = Module::findOrFail($moduleId);

        $pdf->loadView('certificate', [
            'user'   => $user,
            'module' => $module
        ]);

        return $pdf->download('Certificate_'.$user->id.'_'.$module->id.'.pdf');
    }
}
