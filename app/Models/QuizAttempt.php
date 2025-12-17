<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'finished_at',
    ];

    // Relasi ke jawaban
    public function answers()
    {
        return $this->hasMany(QuizAttemptAnswer::class, 'attempt_id');
    }

    // Relasi ke quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi ke user (opsional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
