<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ScheduleParticipant;


class Schedule extends Model
{
    protected $fillable = [
        'title',
        'description',
        'meeting_link',
        'mentor_id',
        'meeting_date',
        'meeting_time'
    ];

    // Setiap schedule dimiliki oleh satu mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function participants()
    {
        return $this->hasMany(ScheduleParticipant::class);
    }


}
