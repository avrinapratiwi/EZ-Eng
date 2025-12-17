<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\ModuleProgress;
use App\Models\LessonProgress;


class LessonController extends Controller
{
    public function showLessonsAdmin(Module $module)
    {
        // Ambil semua lessons dari modul ini
        $lessons = $module->lessons()->orderBy('order')->get();

        return view('lessons-admin', [
            'module' => $module,
            'lessons' => $lessons
        ]);
    }
    
    public function storeLesson(Request $request, Module $module)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'konten_html' => 'nullable|string',
            'order' => 'required|integer',
        ]);
    
        // Simpan lesson baru
        Lesson::create([
            'module_id' => $module->id,
            'title' => $validated['title'],
            'konten_html' => $validated['konten_html'],
            'order' => $validated['order'],
        ]);
    
        return redirect()->back()->with('success', 'Lesson berhasil ditambahkan!');
    }

    public function updateLesson(Request $request, Module $module, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'konten_html' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        $lesson->update($validated);

        return redirect()->back()->with('success', 'Lesson berhasil diperbarui!');
    }

    public function deleteLesson(Module $module, Lesson $lesson)
    {
        $lesson->delete();

        return redirect()->back()->with('success', 'Lesson berhasil dihapus!');
    }

    public function showLessonLearner($moduleId, $lessonId)
    {
        $user = session('user');
        if (!$user) {
            return redirect('/login');
        }
    
        $module = Module::with(['lessons', 'quiz'])->findOrFail($moduleId);
    
        $lesson = Lesson::where('module_id', $moduleId)
            ->where('id', $lessonId)
            ->firstOrFail();
    
        // ===============================
        // 🔒 VALIDASI URUTAN LESSON
        // ===============================
        if ($lesson->order > 1) {
            $previousLesson = Lesson::where('module_id', $moduleId)
                ->where('order', $lesson->order - 1)
                ->first();
    
            $isPreviousCompleted = LessonProgress::where([
                'user_id'   => $user->id,
                'lesson_id' => $previousLesson->id
            ])->exists();
    
            if (!$isPreviousCompleted) {
                return redirect()->back()
                    ->with('error');
            }
        }
        LessonProgress::firstOrCreate(
            [
                'user_id'   => $user->id,
                'lesson_id' => $lessonId,
            ],
            [
                'module_id'    => $moduleId,
                'completed_at' => now(),
            ]
        );
 
        $completedLessons = LessonProgress::where('user_id', $user->id)
            ->where('module_id', $moduleId)
            ->pluck('lesson_id')
            ->toArray();
    
        $totalLessons   = $module->lessons->count();
        $completedCount = count($completedLessons);
    
        $canAccessQuiz = $completedCount === $totalLessons;
    
        $quizCompleted = ModuleProgress::where('user_id', $user->id)
            ->where('module_id', $moduleId)
            ->where('completed', true)
            ->exists();
    
        return view('lessons-learner', compact(
            'module',
            'lesson',
            'user',
            'completedLessons',
            'canAccessQuiz',
            'quizCompleted'
        ));
    }
    
    
}
