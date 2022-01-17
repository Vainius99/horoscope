<?php

namespace App\Models;
use App\Models\HoroscopeSign;
use App\Models\Horoscope;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoroscopeScore extends Model
{
    // public function signScore() {
    //     return $this->belongsTo(HoroscopeSign::class, 'sign_id', 'id');
    // }
    public function yearScore() {
        return $this->belongsTo(Horoscope::class, 'year_id', 'id');
    }
    // public function getDayFormat() {
    //     return Carbon::createFromDate($this->attributes['day'])->format('y-m-d');
    // }
}
