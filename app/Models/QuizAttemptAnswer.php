<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttemptAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt_id',
        'question_id',
        'user_answer',
        'is_correct',
    ];

    // Relasi ke question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Relasi ke attempt
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id');
    }
}
