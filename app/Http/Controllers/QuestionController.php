<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuizAttemptAnswer;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showQuestionsAdmin(Quiz $quiz)
    {
        $questions = $quiz->questions()->orderBy('id')->get();

        return view('questions-admin', [
            'quiz' => $quiz,
            'questions' => $questions
        ]);
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $validated['question_text'],
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
            'correct_answer' => $validated['correct_answer'],
        ]);

        return redirect()->back()->with('success', 'Question added!');
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $validated = $request->validate([
            'question_text_edit' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);
    
        $question->update([
            'question_text' => $validated['question_text_edit'],
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
            'correct_answer' => $validated['correct_answer'],
        ]);
    
        return redirect()->back()->with('success', 'Question updated!');
    }
    
    public function deleteQuestion(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted!');
    }
    
    public function showQuestionLearner(Quiz $quiz, $number)
    {
        $user = session('user');
    
        $questions = $quiz->questions()->orderBy('id')->get();
        $question = $questions[$number - 1] ?? abort(404);
    
        $attempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->latest()
            ->first();
    
        $answeredQuestionIds = $attempt
            ? $attempt->answers->pluck('question_id')->toArray()
            : [];
    
        return view('questions-learner', [
            'quiz' => $quiz,
            'question' => $question,
            'number' => $number,
            'totalQuestions' => $questions->count(),
            'questions' => $questions,
            'answeredQuestionIds' => $answeredQuestionIds,
            'user' => $user
        ]);
    }
    
    
}
