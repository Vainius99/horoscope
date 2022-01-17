<?php

namespace App\Models;
use App\Models\HoroscopeScore;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    public function horoscopeHoroscopeScores() {
        return $this->hasMany(HoroscopeScore::class, 'year_id', 'id');
    }
}
