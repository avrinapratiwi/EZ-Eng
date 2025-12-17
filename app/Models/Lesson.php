<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    // Kolom-kolom yang boleh diisi mass assignment
    protected $fillable = [
        'module_id',
        'title',
        'konten_html',
        'order',
    ];

    /**
     * Relasi ke modul
     * Setiap lesson hanya milik satu module
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
