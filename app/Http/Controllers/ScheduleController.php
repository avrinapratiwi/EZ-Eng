<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mentor;
use App\Models\User;
use App\Models\Schedule;
use App\Models\ScheduleParticipant;



class ScheduleController extends Controller
{
    public function showSchedule()
    {
        $user = Session::get('user'); // admin login (array / object)
        $mentors = Mentor::all();
    
        // INI YANG BENAR
        $learners = User::where('role', 'learner')->get();
    
        $schedules = Schedule::with('mentor')->get();
    
        return view('schedule-admin', compact(
            'user',
            'mentors',
            'learners',
            'schedules'
        ));
    }
    
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_link' => 'required|url',
            'mentor_id' => 'required|exists:mentors,id',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required',
            'learners' => 'required|array',
            'learners.*' => 'exists:users,id',
        ]);
    
        $schedule = Schedule::create([
            'title' => $request->title,
            'meeting_link' => $request->meeting_link,
            'mentor_id' => $request->mentor_id,
            'meeting_date' => $request->meeting_date,
            'meeting_time' => $request->meeting_time,
        ]);
    
        foreach ($request->learners as $learnerId) {
            ScheduleParticipant::create([
                'schedule_id' => $schedule->id,
                'learner_id' => $learnerId,
                'status' => null,
            ]);            
        }
    
        return redirect()
            ->route('schedule-admin')
            ->with('success', 'Schedule successfully created');
    }
    

    public function updateSchedule(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_link' => 'required|url',
            'mentor_id' => 'required|exists:mentors,id',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required',
            'learners' => 'required|array',
            'learners.*' => 'exists:users,id',
        ]);

        // update schedule utama
        $schedule->update([
            'title' => $request->title,
            'meeting_link' => $request->meeting_link,
            'mentor_id' => $request->mentor_id,
            'meeting_date' => $request->meeting_date,
            'meeting_time' => $request->meeting_time,
        ]);

        // hapus peserta lama
        $schedule->participants()->delete();

        // simpan peserta baru
        foreach ($request->learners as $learnerId) {
            $schedule->participants()->create([
                'learner_id' => $learnerId,
                'status' => 'ABSENT',
            ]);
        }

        return redirect()
            ->route('schedule-admin')
            ->with('success', 'Schedule successfully updated');
    }

    public function deleteSchedule(Schedule $schedule)
    {
        // otomatis hapus participants karena onDelete('cascade')
        $schedule->delete();

        return redirect()
            ->route('schedule-admin')
            ->with('success', 'Schedule successfully deleted');
    }

    public function attendance(Schedule $schedule)
    {
        $user = Session::get('user');

        $schedule->load([
            'mentor',
            'participants.learner'
        ]);

        return view('attendance-admin', compact(
            'user',
            'schedule'
        ));
    }

    public function updateAttendance(Request $request, Schedule $schedule)
    {
        foreach ($request->attendance as $participantId => $status) {
            ScheduleParticipant::where('id', $participantId)
                ->update(['status' => $status]);
        }

        return redirect()
            ->route('schedule-admin')
            ->with('success', 'Attendance updated successfully');
    }


    public function showScheduleList()
    {
        $user = Session::get('user');
    
        // HANYA schedule yang memang punya participant = user ini
        $schedules = Schedule::whereHas('participants', function ($q) use ($user) {
                $q->where('learner_id', $user->id);
            })
            ->with(['mentor', 'participants'])
            ->orderBy('meeting_date', 'asc')
            ->orderBy('meeting_time', 'asc')
            ->get();
    
        // kelompokkan
        $pastSchedules = [];
        $upcomingSchedules = [];
    
        foreach ($schedules as $schedule) {
            $scheduleDateTime = \Carbon\Carbon::parse(
                $schedule->meeting_date . ' ' . $schedule->meeting_time
            );
    
            if ($scheduleDateTime->isPast()) {
                $pastSchedules[] = $schedule;
            } else {
                $upcomingSchedules[] = $schedule;
            }
        }
    
        return view('schedule-learner', compact(
            'user',
            'pastSchedules',
            'upcomingSchedules'
        ));
    }
    


}
