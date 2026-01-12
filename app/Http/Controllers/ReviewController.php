<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Module;
use App\Models\QuizAttempt;
use Barryvdh\DomPDF\Facade\Pdf;

class ReviewController extends Controller
{
    public function certificate($moduleId)
    {
        $user = Session::get('user');
        $module = Module::findOrFail($moduleId);
    
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->whereHas('quiz', function ($q) use ($moduleId) {
                $q->where('module_id', $moduleId);
            })
            ->orderByDesc('id')
            ->first();
    
        return view('certificate', compact('user','module','attempt'));
    }
    



}
