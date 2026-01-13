<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Schedule;
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

        // Total modules
        $totalModules = Module::count();

        // Total lessons
        $totalLessons = Lesson::count();

        // Total quizzes
        $totalQuizzes = Quiz::count();

        // Total schedules
        $totalSchedules = Schedule::count();

        return view('dashboard-admin', compact(
            'user',
            'totalActiveLearners',
            'totalActiveMentors',
            'totalModules',
            'totalLessons',
            'totalQuizzes',
            'totalSchedules'
        ));
    }
}
