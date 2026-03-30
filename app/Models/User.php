<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password',
        'role', 'status', 'phone', 'location',
        'bio', 'profile_photo', 'warning_count'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function teacherProfile() {
        return $this->hasOne(TeacherProfile::class);
    }
    public function coursesAsTeacher() {
        return $this->hasMany(Course::class, 'teacher_id');
    }
    public function reservationsAsStudent() {
        return $this->hasMany(Reservation::class, 'student_id');
    }
    public function reservationsAsTeacher() {
        return $this->hasMany(Reservation::class, 'teacher_id');
    }
    public function reviewsGiven() {
        return $this->hasMany(Review::class, 'student_id');
    }
    public function reviewsReceived() {
        return $this->hasMany(Review::class, 'teacher_id');
    }
    public function passwordHistory() {
        return $this->hasMany(PasswordHistory::class);
    }
    public function isAdmin() { return $this->role === 'admin'; }
    public function isTeacher() { return $this->role === 'teacher'; }
    public function isStudent() { return $this->role === 'student'; }
    public function isApproved() { return $this->status === 'approved'; }
}