<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'teacher_id', 'naziv', 'opis', 'nivo', 'cena',
        'tip', 'is_featured', 'is_active', 'slika',
        'max_students', 'trajanje_minuta'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}