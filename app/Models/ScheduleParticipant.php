<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;

class ScheduleParticipant extends Model
{
    protected $fillable = [
        'schedule_id',
        'learner_id',
        'status'
    ];

    public function learner()
    {
        return $this->belongsTo(User::class, 'learner_id');
    }

    // (opsional tapi bagus)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
