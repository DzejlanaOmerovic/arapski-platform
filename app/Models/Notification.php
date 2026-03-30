<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'naslov', 'sadrzaj', 'tip', 'is_active', 'created_by'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
}