<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HoroscopeSign;

class HoroscopeSignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $horoscope_signs = [
        'Aries', 'Taurus', 'Gemini', 'Cancer',
        'Leo', 'Virgo', 'Libra', 'Scorpio',
        'Sagittarius', 'Capricorn', 'Aquarius',
        'Pisces'
        ];

        foreach($horoscope_signs as $horoscope_sign){
            HoroscopeSign::create([
                'title' => $horoscope_sign,
            ]);
        }
    }
}
