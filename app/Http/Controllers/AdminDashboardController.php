<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use Illuminate\Support\Facades\Session;

class AdminDashboardController extends Controller
{
    public function data()
    {
        $user = Session::get('user');

        // Total learners aktif
        $totalActiveLearners = User::where('role', 'learner')
            ->where('status', 'AKTIF')
            ->count();

        // Total mentor aktif
        $totalActiveMentors = Mentor::where('status', 'AKTIF')->count();

        return view('dashboard-admin', compact(
            'user',
            'totalActiveLearners',
            'totalActiveMentors'
        ));
    }
}
