<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\ModuleProgress;
use App\Models\QuizAttempt;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\File;

class ModuleController extends Controller
{
    /**
     * Tampilkan halaman admin untuk modul
     */
    public function showModulesAdmin()
    {
        $modules = Module::orderBy('order', 'asc')->get();
        return view('modules-admin', compact('modules'));
    }

    /**
     * Simpan modul baru
     */
    public function storeModule(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'order'       => 'required|integer|min:1',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            // ROOT public_html
            $publicHtml = dirname(base_path()) . '/public_html';
            $uploadPath = $publicHtml . '/storage/photos';

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $imagePath = 'storage/photos/' . $fileName;
        }

        Module::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
            'order'       => $request->order,
        ]);

        return redirect()->back()->with('success', 'Module successfully added!');
    }

    /**
     * Update modul
     */
    public function updateModule(Request $request, $id)
    {
        $module = Module::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:png,jpg|max:5120',
            'order'       => 'required|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            $publicHtml = dirname(base_path()) . '/public_html';
            $uploadPath = $publicHtml . '/storage/photos';

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Hapus image lama jika ada
            if ($module->image) {
                $oldFile = $publicHtml . '/' . ltrim($module->image, '/');
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);

            $module->image = 'storage/photos/' . $fileName;
        }

        $module->update([
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $request->order,
            'image'       => $module->image,
        ]);

        return redirect()->back()->with('success', 'Module successfully updated!');
    }

    /**
     * Hapus modul
     */
    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);

        if ($module->image) {
            $publicHtml = dirname(base_path()) . '/public_html';
            $oldFile = $publicHtml . '/' . ltrim($module->image, '/');
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
        }

        $module->delete();
        return redirect()->back()->with('success', 'Module successfully deleted!');
    }

    /**
     * Tampilkan modul untuk learner
     */
    public function showModulesLearner(Request $request)
    {
        $user = session('user');

        $query = Module::with(['lessons', 'quiz'])
            ->orderBy('order');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $modules = $query->get();
        $moduleProgressData = [];

        foreach ($modules as $module) {
            $lessonDone = LessonProgress::where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->count();

            $lessonTotal = $module->lessons->count();

            $quizDone = ModuleProgress::where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->where('completed', true)
                ->exists() ? 1 : 0;

            $totalItem = $lessonTotal + ($module->quiz ? 1 : 0);
            $doneItem  = $lessonDone + $quizDone;

            $percent = $totalItem > 0
                ? round(($doneItem / $totalItem) * 100)
                : 0;

            $moduleProgressData[$module->id] = [
                'percent' => $percent,
                'lesson_total' => $lessonTotal,
            ];
        }

        return view('module-learner', compact(
            'modules',
            'moduleProgressData',
            'user'
        ));
    }

    /**
     * Tampilkan review modul untuk learner
     */
    public function showReviewsLearner()
    {
        $user = session('user');

        $modules = Module::with('quiz')
            ->orderBy('order', 'asc')
            ->get();

        $reviews = [];

        foreach ($modules as $module) {
            $moduleProgress = ModuleProgress::where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->first();

            $quizAttempt = null;
            $score = null;
            $finishedAt = null;
            $passed = false;
            $reviewLink = null;

            if ($moduleProgress && $moduleProgress->quiz_attempt_id) {
                $quizAttempt = QuizAttempt::find($moduleProgress->quiz_attempt_id);

                if ($quizAttempt) {
                    $score = $quizAttempt->score;
                    $finishedAt = $quizAttempt->finished_at;
                    $passed = $score >= 70;
                    $reviewLink = route('quiz.review', $quizAttempt->id);
                }
            }

            $reviews[] = [
                'module_title' => $module->title,
                'passed'       => $passed,
                'finished_at'  => $finishedAt,
                'score'        => $score,
                'review_link'  => $reviewLink,
                'module_id'    => $module->id,
            ];
        }

        return view('reviews-learner', compact('user', 'reviews'));
    }
}
