<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Module;
use App\Models\QuizAttempt;
use Barryvdh\DomPDF\PDF;

class ReviewController extends Controller
{
    public function certificate($moduleId)
    {
        $user = Session::get('user');

        $module = Module::findOrFail($moduleId);

        $attempt = QuizAttempt::where('user_id', $user->id)
            ->latest()
            ->first();

        return view('certificate', [
            'user'   => $user,
            'module' => $module,
            'attempt'=> $attempt
        ]);
    }

    public function downloadCertificate($moduleId)
    {
        $user = Session::get('user');
        $module = Module::findOrFail($moduleId);

        /** @var PDF $pdf */
        $pdf = App::make(PDF::class);

        $pdf->loadView('certificate', [
            'user'   => $user,
            'module' => $module
        ]);

        return $pdf->download('Certificate_'.$user->id.'_'.$module->id.'.pdf');
    }
}
