<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Module;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\Question;
use App\Models\ModuleProgress;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Tampilkan daftar quiz untuk admin
     */
    public function showQuizAdmin()
    {
        $quizzes = Quiz::with('module')->get();
        $modules = Module::orderBy('order')->get(); // ambil modules untuk select
        return view('quizzes-admin', compact('quizzes', 'modules'));
    }
    
    

    /**
     * Simpan quiz baru
     */
    public function storeQuizAdmin(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        Quiz::create([
            'module_id' => $request->module_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Quiz berhasil dibuat.');
    }

    /**
     * Update quiz
     */
    public function updateQuizAdmin(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Quiz berhasil diperbarui.');
    }

    /**
     * Hapus quiz
     */
    public function deleteQuizAdmin($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->back()->with('success', 'Quiz berhasil dihapus.');
    }
    
    public function startQuizLearner(Quiz $quiz)
    {
        $user = session('user');
    
        // cek apakah user sudah punya module progress untuk modul ini
        $progress = ModuleProgress::where('user_id', $user->id)
            ->where('module_id', $quiz->module_id)
            ->first();
    
        if ($progress && $progress->quiz_attempt_id) {
            // user sudah mengerjakan quiz → langsung ke review
            return redirect()->route('quiz.review', $progress->quiz_attempt_id);
        }
    
        $quiz->loadCount('questions');
    
        return view('start-quiz-lesson', compact('quiz', 'user'));
    }
    
    
    public function reviewQuiz($attemptId)
    {
        $user = session('user');
    
        $attempt = QuizAttempt::with(['answers.question'])
            ->where('id', $attemptId)
            ->where('user_id', $user->id)
            ->firstOrFail();
    
        $totalQuestions = $attempt->answers->count();
        $correctAnswers = $attempt->answers->where('is_correct', true)->count();
        $wrongAnswers = $totalQuestions - $correctAnswers;
        $scorePerQuestion = 100 / $totalQuestions;
        $score = round($correctAnswers * $scorePerQuestion);
    
        return view('question-review-learner', compact('attempt', 'totalQuestions', 'correctAnswers', 'wrongAnswers', 'score'));
    }
    
    
    public function submitAnswer(Request $request, Quiz $quiz, Question $question)
    {
        $user = session('user');
        $userAnswer = $request->input('answer');
    
        // Ambil atau buat attempt aktif
        $attempt = QuizAttempt::firstOrCreate(
            ['quiz_id' => $quiz->id, 'user_id' => $user->id, 'finished_at' => null]
        );
    
        // Simpan jawaban
        QuizAttemptAnswer::updateOrCreate(
            ['attempt_id' => $attempt->id, 'question_id' => $question->id],
            [
                'user_answer' => $userAnswer,
                'is_correct' => $question->correct_answer === $userAnswer
            ]
        );
    
        // Ambil semua soal
        $questions = $quiz->questions()->orderBy('id')->get();
        $currentIndex = $questions->search(fn($q) => $q->id == $question->id);
    
        // Next soal
        if ($currentIndex < $questions->count() - 1) {
            $nextNumber = $currentIndex + 2; // 1-based
            return redirect()->route('quiz.question', [$quiz->id, $nextNumber]);
        } else {
            // Finish quiz → hitung nilai
            $totalQuestions = $questions->count();
            $correctAnswers = $attempt->answers()->where('is_correct', true)->count();
            $wrongAnswers = $totalQuestions - $correctAnswers;
    
            $scorePerQuestion = 100 / $totalQuestions;
            $score = round($correctAnswers * $scorePerQuestion); // total nilai
    
            $attempt->update([
                'finished_at' => now(),
                'score' => $score
            ]);
    
            // ✅ Update progress modul
            \App\Models\ModuleProgress::updateOrCreate(
                ['user_id' => $user->id, 'module_id' => $quiz->module_id],
                [
                    'completed' => true,
                    'quiz_attempt_id' => $attempt->id
                ]
            );
    
            return redirect()->route('quiz.review', $attempt->id);
        }
    }
    
    
    


}
