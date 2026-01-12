<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Session;

Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/verify/{token}', [AuthController::class, 'verify']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard-admin', function () {$user = Session::get('user');return view('dashboard-admin', compact('user'));})->name('dashboard-admin');
Route::get('/dashboard-learner', function () {$user = Session::get('user');return view('dashboard-learner', compact('user'));})->name('dashboard-learner');

Route::get('/profile-learner', function () {$user = Session::get('user');return view('profile-learner', compact('user'));})->name('profile-learner');
Route::post('/update-profile-learner', [ProfileController::class, 'updateProfile'])->name('update-profile-learner');
Route::get('/profile-admin', function () {$user = Session::get('user');return view('profile-admin', compact('user'));})->name('profile-admin');
Route::post('/update-profile-admin', [ProfileController::class, 'updateProfile'])->name('update-profile-admin');

Route::get('/learners-admin', [UserController::class, 'showLearnersAdmin'])->name('learners-admin');
Route::get('/mentors-admin', [UserController::class, 'showMentorAdmin'])->name('mentors-admin');
Route::post('/mentors/store', [UserController::class, 'storeMentor'])->name('mentors-store');
Route::post('/mentors/update/{id}', [UserController::class, 'updateMentor'])->name('mentors-update');
Route::delete('/mentors/delete/{id}', [UserController::class, 'deleteMentor'])->name('mentors-delete');

Route::get('/modules-admin', [ModuleController::class, 'showModulesAdmin'])->name('modules-admin');
Route::post('/modules/store', [ModuleController::class, 'storeModule'])->name('modules-store');
Route::put('/modules/update/{id}', [ModuleController::class, 'updateModule'])->name('modules-update');
Route::delete('/modules/delete/{id}', [ModuleController::class, 'deleteModule'])->name('modules-delete');

Route::get('/lessons/{module}', [LessonController::class, 'showLessonsAdmin'])->name('lessons.show');
Route::post('/admin/modules/{module}/lessons/store', [LessonController::class, 'storeLesson'])->name('lessons.store');
Route::post('/admin/modules/{module}/lessons/{lesson}/update', [LessonController::class, 'updateLesson'])->name('lessons.update');
Route::delete('/admin/modules/{module}/lessons/{lesson}/delete', [LessonController::class, 'deleteLesson'])->name('lessons.delete');


Route::get('/quizzes-admin', [QuizController::class, 'showQuizAdmin'])->name('quizzes-admin');
Route::post('/quizzes/store', [QuizController::class, 'storeQuizAdmin'])->name('quizzes-store');
Route::post('/quizzes/update/{quiz}', [QuizController::class, 'updateQuizAdmin'])->name('quizzes-update');
Route::delete('/quizzes/delete/{quiz}', [QuizController::class, 'deleteQuizAdmin'])->name('quizzes-delete');


Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'showQuestionsAdmin'])->name('questions.show');
Route::post('/admin/quizzes/{quiz}/questions/store', [QuestionController::class, 'storeQuestion'])->name('questions.store');
Route::post('/admin/quizzes/{quiz}/questions/{question}/update', [QuestionController::class, 'updateQuestion'])->name('questions.update');
Route::delete('/admin/quizzes/{quiz}/questions/{question}/delete', [QuestionController::class, 'deleteQuestion'])->name('questions.delete');


Route::get('/schedule-admin', [ScheduleController::class, 'showSchedule'])->name('schedule-admin');
Route::post('/schedule/store', [ScheduleController::class, 'storeSchedule'])->name('schedules.store');
Route::put('/schedule/{schedule}', [ScheduleController::class, 'updateSchedule'])->name('schedules.update');
Route::delete('/schedule/{schedule}', [ScheduleController::class, 'deleteSchedule'])->name('schedules.delete');
Route::get('/admin/schedule/{schedule}/attendance',[ScheduleController::class, 'attendance'])->name('schedule.attendance');
Route::post('/admin/schedule/{schedule}/attendance',[ScheduleController::class, 'updateAttendance'])->name('schedule.attendance.update');


Route::get('/my-courses', [ModuleController::class, 'showModulesLearner'])->name('modules-learner');
Route::get('/learner/module/{module}/lesson/{lesson}', [LessonController::class, 'showLessonLearner'])->name('learner.lesson');
Route::get('/learner/quiz/{quiz}', [QuizController::class, 'startQuizLearner'])->name('quiz.start');
Route::get('/learner/quiz/{quiz}/question/{number}', [QuestionController::class, 'showQuestionLearner'])->name('quiz.question');
Route::get('quiz/review/{attemptId}', [QuizController::class, 'reviewQuiz'])->name('quiz.review');
Route::post('quiz/{quiz}/question/{question}/answer', [QuizController::class, 'submitAnswer'])->name('quiz.answer');
Route::get('quiz/review/{attempt}', [QuizController::class, 'reviewQuiz'])->name('quiz.review');
Route::get('/schedule', [ScheduleController::class, 'showScheduleList'])->name('schedule-list');
Route::get('/schedule', [ScheduleController::class, 'showScheduleList'])->name('schedule-learner');
Route::get('/learner/reviews', [ModuleController::class, 'showReviewsLearner'])->name('reviews-learner');


Route::get('/dashboard-learner', [DashboardController::class, 'index'])->name('dashboard-learner');
Route::get('/messages', [MessageController::class, 'index'])->name('messages-learner');
Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
Route::get('/review/certificate/{module}', [ReviewController::class, 'certificate'])->name('review.certificate');
