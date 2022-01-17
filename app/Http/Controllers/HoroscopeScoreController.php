<?php

namespace App\Http\Controllers;


use App\Models\Horoscope;
use App\Models\HoroscopeSign;
use App\Models\HoroscopeScore;
use App\Http\Requests\StoreHoroscopeScoreRequest;
use App\Http\Requests\UpdateHoroscopeScoreRequest;
use Illuminate\Http\Request;
use DB;


class HoroscopeScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $year = $request->input('id');
        $year_filter = $request->year_filter;
        $sign_filter = $request->sign_filter;
        $year_title='';
        $sign_title='';
        $year_number = 1;


        $months = [ 'January', 'February', 'March', 'April',
        'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'];

        $colors = array('1'=>'#ff0000', '2' => '#ff6c00', '3' => '#ff9700', '4' => '#ffc100', '5' => '#ffe400',
        '6' => '#f7ff00', '7' => '#fff300', '8' => '#aaff00', '9' => '#80ff00', '10' => '#00ff00');

        // $best_year = array('');
        // $best_sign = array('');

        $horoscopes = Horoscope::all();
        $horoscope_score_totals = HoroscopeScore::all();
        $horoscope_signs = HoroscopeSign::all();

        foreach ($horoscopes->sortBy('title') as $horoscope) {
            $year_number++;
            // $score_sign = '';
            // $count_sign = '';
                foreach($horoscope_signs as $horoscope_sign) {
                    $score_sign = DB::table('horoscope_scores')->where('sign_id', $horoscope_sign->id)->where('year_id', $horoscope->id)->avg('dayscore');
                    $best_sign[$horoscope_sign->title] = ($score_sign);
                }
            if ( !empty($best_sign))  {
                $best_avg = max($best_sign);
                    foreach ($best_sign as $key=>$value) {
                        if ($value == $best_avg) {
                            $best_year[$horoscope->title]['1'] = ($value);
                            $best_year[$horoscope->title]['2'] = ($key);
                        }
                    }
            // } else {
            //     $best_avg = '';
            };

        };

        if ( !empty($best_avg))  {
        } else {
            $best_year = '';
            $best_sign = '';
        };

        // var_dump($best_sign);

        // var_dump($best_year);


        if ($year_filter && $sign_filter) {
        $year_title = DB::table('horoscopes')->where('id', $year_filter)->value('title');
        $sign_title = DB::table('horoscope_signs')->where('id', $sign_filter)->value('title');
        $horoscope_scores = HoroscopeScore::all()->where('year_id', '=' ,$year_filter)->where('sign_id', '=' ,$sign_filter);
        } else {
        $horoscope_scores = HoroscopeScore::all();
        }
        $error = "Choose Year and Sign";
        $year_avg = HoroscopeScore::where('year_id', '=' ,$year_filter)->where('sign_id', '=' ,$sign_filter)->avg('dayscore');
        $month_avg = array();
        foreach ($months as $month) {
            $score = 0;
            $count = 1;
            foreach ($horoscope_scores as $horoscope_score) {
                if (date('F',strtotime($horoscope_score->day)) == $month) {
                    $score = $score + $horoscope_score->dayscore;
                    $count++;
                }
            }
            $count = $count - 1;
            if ( $count == 0 ) {
                $count = "wtf kodel cia meta klaida? ";
            } else {
                $month_avg[$month] = ($score/$count);
            }
        }
        if ( !empty($month_avg))  {
            $best = max($month_avg);
        } else {
            $best = '';
        };

        return view('calendor.index', ['horoscopes' => $horoscopes,'horoscope_signs' => $horoscope_signs, 'horoscope_scores' => $horoscope_scores,
        'year_filter' => $year_filter, 'sign_filter' => $sign_filter, 'year' => $year, 'months' => $months, 'error' => $error, 'colors' => $colors,
        'year_avg' => $year_avg,'month_avg' => $month_avg, 'best' => $best, 'year_title' => $year_title, 'sign_title' => $sign_title,
        'horoscope_score_totals' => $horoscope_score_totals, 'best_year' => $best_year, 'best_sign' => $best_sign, 'year_number' => $year_number ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHoroscopeScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoroscopeScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HoroscopeScore  $horoscopeScore
     * @return \Illuminate\Http\Response
     */
    public function show(HoroscopeScore $horoscopeScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HoroscopeScore  $horoscopeScore
     * @return \Illuminate\Http\Response
     */
    public function edit(HoroscopeScore $horoscopeScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHoroscopeScoreRequest  $request
     * @param  \App\Models\HoroscopeScore  $horoscopeScore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHoroscopeScoreRequest $request, HoroscopeScore $horoscopeScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HoroscopeScore  $horoscopeScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoroscopeScore $horoscopeScore)
    {
        //
    }
}

