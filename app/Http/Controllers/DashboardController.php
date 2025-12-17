<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\Schedule;
use App\Models\ModuleProgress;
use App\Models\LessonProgress;
use App\Models\ScheduleParticipant;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Session::get('user');

        // Total modules
        $totalModules = Module::count();

        // Total quizzes
        $totalQuizzes = Quiz::count();

        // Upcoming schedules yang statusnya bukan PRESENT atau ABSENT
        // Upcoming schedules user ikut serta
        $upcomingSchedules = ScheduleParticipant::where('learner_id', $user->id)
                                ->whereHas('schedule', function($q) {
                                    $q->whereDate('meeting_date', '>=', now());
                                })
                                ->count();



        // Total completed courses
        $completedCourses = ModuleProgress::where('user_id', $user->id)
                                ->where('completed', true)
                                ->count();

        // Leaderboard
        $learners = User::where('role', 'learner')->get();

        $totalLessons = LessonProgress::count();
        $totalQuizzesProgress = ModuleProgress::count();
        $totalSchedules = ScheduleParticipant::count();
        $totalMax = $totalLessons + $totalQuizzesProgress + $totalSchedules;

        $leaderboard = [];
        $chartData = []; // Kirim ke view

        foreach ($learners as $learner) {
            $lessonsCompleted = LessonProgress::where('user_id', $learner->id)->count();
            $quizzesCompleted = ModuleProgress::where('user_id', $learner->id)
                                    ->where('completed', true)
                                    ->count();
            $attendances = ScheduleParticipant::where('learner_id', $learner->id)
                            ->where('status', 'PRESENT')
                            ->count();

            $totalProgress = $lessonsCompleted + $quizzesCompleted + $attendances;
            $progressPercentage = $totalMax > 0 ? round(($totalProgress / $totalMax) * 100, 2) : 0;

            $leaderboard[] = [
                'learner' => $learner,
                'lessonsCompleted' => $lessonsCompleted,
                'quizzesCompleted' => $quizzesCompleted,
                'attendances' => $attendances,
                'totalProgress' => $totalProgress,
                'progressPercentage' => $progressPercentage
            ];

            $chartData[$learner->id] = [
                'lessons' => $lessonsCompleted,
                'quizzes' => $quizzesCompleted,
                'attendances' => $attendances
            ];
        }

        usort($leaderboard, fn($a,$b) => $b['totalProgress'] <=> $a['totalProgress']);

        return view('dashboard-learner', compact(
            'user', 
            'totalModules',
            'totalQuizzes',
            'upcomingSchedules',
            'completedCourses',
            'leaderboard',
            'chartData'
        ));
    }
}
