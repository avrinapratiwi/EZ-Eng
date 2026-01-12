<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\QuizAttempt;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function downloadCertificate($moduleId)
    {
        $user = Session::get('user');
        $module = Module::findOrFail($moduleId);
    
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('certificate', [
            'user' => $user,
            'module' => $module
        ]);
        $pdf->setPaper('A4', 'landscape');
    
        $fileName = 'Certificate_'.$user->id.'_'.$module->id.'.pdf';
    
        return $pdf->download($fileName);
    }
    
    
}
