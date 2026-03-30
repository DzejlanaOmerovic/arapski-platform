<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'student_id', 'teacher_id', 'course_id',
        'datum', 'trajanje_minuta', 'status', 'napomena', 'cena'
    ];

    protected $casts = ['datum' => 'datetime'];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function course() {
        return $this->belongsTo(Course::class);
    }
    public function review() {
        return $this->hasOne(Review::class);
    }
}