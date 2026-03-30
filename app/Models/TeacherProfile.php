<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    protected $fillable = [
        'user_id', 'about', 'arabic_level', 'price_per_hour',
        'teaching_style', 'availability', 'languages',
        'offers_group', 'offers_individual', 'is_featured', 'discount'
    ];

    protected $casts = [
        'availability' => 'array',
        'languages' => 'array',
        'offers_group' => 'boolean',
        'offers_individual' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function averageRating() {
        return $this->user->reviewsReceived()->avg('ocena');
    }
}