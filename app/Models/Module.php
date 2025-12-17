<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // Jika nama tabel sesuai konvensi (modules), property $table bisa dihilangkan
    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
    ];

    /**
     * Relasi satu modul memiliki banyak lesson
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order', 'asc');
    }

    /**
     * Relasi modul ke quiz (jika setiap modul punya quiz)
     */
    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}
