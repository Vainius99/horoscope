<?php

namespace App\Http\Controllers;

use App\Models\HoroscopeSign;
use App\Http\Requests\StoreHoroscopeSignRequest;
use App\Http\Requests\UpdateHoroscopeSignRequest;

class HoroscopeSignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreHoroscopeSignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoroscopeSignRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HoroscopeSign  $horoscopeSign
     * @return \Illuminate\Http\Response
     */
    public function show(HoroscopeSign $horoscopeSign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HoroscopeSign  $horoscopeSign
     * @return \Illuminate\Http\Response
     */
    public function edit(HoroscopeSign $horoscopeSign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHoroscopeSignRequest  $request
     * @param  \App\Models\HoroscopeSign  $horoscopeSign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHoroscopeSignRequest $request, HoroscopeSign $horoscopeSign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HoroscopeSign  $horoscopeSign
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoroscopeSign $horoscopeSign)
    {
        //
    }
}
