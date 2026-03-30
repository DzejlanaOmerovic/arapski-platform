<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $fillable = ['kljuc', 'vrednost', 'opis'];

    public static function get($key, $default = null) {
        $setting = self::where('kljuc', $key)->first();
        return $setting ? $setting->vrednost : $default;
    }

    public static function set($key, $value) {
        return self::updateOrCreate(
            ['kljuc' => $key],
            ['vrednost' => $value]
        );
    }
}