<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'student_id', 'teacher_id', 'reservation_id', 'ocena', 'komentar'
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function reservation() {
        return $this->belongsTo(Reservation::class);
    }
}