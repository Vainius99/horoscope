<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use App\Models\HoroscopeSign;
use App\Models\HoroscopeScore;
use App\Http\Requests\StoreHoroscopeRequest;
use App\Http\Requests\UpdateHoroscopeRequest;
use DateTime;
use Illuminate\Http\Request;
use Validator;

class HoroscopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horoscopes = Horoscope::all();
        $horoscope_signs = HoroscopeSign::all();
        $horoscope_scores = HoroscopeScore::all();
        return view('horoscope.index', ['horoscopes' => $horoscopes,'horoscope_signs' => $horoscope_signs, 'horoscope_scores' => $horoscope_scores]);
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
     * @param  \App\Http\Requests\StoreHoroscopeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoroscopeRequest $request)
    {
        //
    }

    public function storeAjax(Request $request) {
        $horoscope = new Horoscope;
        $horoscope_score = new HoroscopeScore;
        $i = 1;

        $input = [
            'horoscope_title' => $request->horoscope_title
        ];
        $rules = [
            'horoscope_title' => 'required|numeric|digits:4|unique:horoscopes,title|min:2022|max:2100',
        ];
        $validator = Validator::make($input, $rules);

        if($validator->passes()) {
            $horoscope->title = $request->horoscope_title;
            $horoscope->save();
            $horoscope_signs = HoroscopeSign::all()->where('id');
            $yearStart = new DateTime("$request->horoscope_title-01-01");
            $yearend = new DateTime("$request->horoscope_title-12-31");

                foreach ($horoscope_signs as $horoscope_sign) {
                    $yearStart = new DateTime("$request->horoscope_title-01-01");
                    for ($i = $yearStart; $i <= $yearend; $i->modify('+1 day')) {
                                $horoscope_score = new HoroscopeScore;
                                $horoscope_score->day = $i;
                                $horoscope_score->dayscore = rand(1,10);
                                $horoscope_score->year_id = $horoscope->id;
                                $horoscope_score->sign_id = $horoscope_sign->id;
                                $horoscope_score->save();
                            };
                        };

            $success = [
                'success' => 'Horoscope generated successfully',
                'horoscope__title' => $horoscope->title,
            ];
            $success_json = response()->json($success);
            return $success_json;
        }
        $errors = [
            'error' => $validator->messages()->get('*')
        ];
        $errors_json = response()->json($errors);
        return $errors_json;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function show(Horoscope $horoscope)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function edit(Horoscope $horoscope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHoroscopeRequest  $request
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHoroscopeRequest $request, Horoscope $horoscope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horoscope  $horoscope
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horoscope $horoscope)
    {
        $horoscope->delete();
        return redirect()->route('horoscope.index');
    }

}
