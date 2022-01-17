@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card">
                <div class="card-header">{{ __('Calendar') }}</div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tr>
                                   <th>Year</th>
                                   <th>Best Sign by Score</th>
                                   <th>Score</th>
                            </tr>
                            @if (!empty($best_year))
                                @foreach ($best_year as $best_year_title=>$name)
                                    <tr>
                                        <td> {{$best_year_title}}</td>
                                        <td> {{$name['2']}}</td>
                                        <td> {!! number_format((float)($name['1']), 1) !!}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                        <form class="row justify-content-center" action="{{route('calendor.index')}}" method="GET">
                            <label class="text-md-right" for="year_filter"> Choose year </label>
                                <select class="form-control" name="year_filter">
                                    <option value="" @if ($year_filter) selected  @else @endif ></option>
                                        @foreach ($horoscopes->sortBy('title') as $horoscope)
                                            <option value="{{$horoscope->id}}" @if ($year == $horoscope->id) selected @elseif ($horoscope->id == $year_filter) selected @endif >{{$horoscope->title}}</option>
                                        @endforeach
                                </select>
                            <label class="text-md-right" for="sign_filter"> Choose sign</label>
                                <select class="form-control" name="sign_filter">
                                    <option value="" @if ($sign_filter) selected  @else @endif > </option>
                                        @foreach ($horoscope_signs as $horoscope_sign)
                                            <option value="{{$horoscope_sign->id}}" @if ($horoscope_sign->id == $sign_filter) selected @endif >{{$horoscope_sign->title}}</option>
                                        @endforeach
                                </select>
                            <button type="submit" class="form-control col-4 btn btn-warning">Filter</button>
                            <a class="btn btn-danger" href="{{ url('/calendors')}}">Clear Filter</a>
                        </form>
                        <div class="row justify-content-center card-body">
                            @if ($year_filter && $sign_filter)
                                <h4> Year: <?php echo $year_title; ?> || <?php echo $sign_title; ?> || Avg score: {!! number_format((float)($year_avg), 1) !!}</h4>
                            @endif
                        </div>
                        <div class="form-group center">
                        </div>
                        <div class="form-group col-12 center">
                            @if ($year_filter && $sign_filter)
                                @foreach ($months as $month)
                                    @foreach ($month_avg as $key=>$value)
                                        @if ($month == $key )
                                            <div class="<?php echo $month ?>col-9 div" style="<?php if ($value == $best) { echo "background-color:rgb(198, 204, 207);"; }; ?>">
                                                <h1><?php echo $month ?> </h1>
                                                <a> Avg score: {!! number_format((float)($value), 1) !!}</a>
                                                <a style="color:rgb(251, 255, 29); font-size:25px"> <?php if ($value == $best) { echo "Best Month !!"; }; ?> </a>
                                        @endif
                                    @endforeach

                                        <table class="table table-dark">
                                            <tr>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                                <th>Sun</th>
                                            </tr>
                                        </table>

                                        @foreach ($horoscope_scores as $horoscope_score)
                                                @if (date('F',strtotime($horoscope_score->day)) == $month)

                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Tue' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif
                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Wed' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif
                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Thu' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif
                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Fri' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif
                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Sat' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif
                                                    @if (date('D',strtotime($horoscope_score->day)) == 'Sun' && date('d',strtotime($horoscope_score->day)) == 01)
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                        <div class="day-none"> <a class="t-size" style="opacity:0"> ? </a> </div>
                                                    @endif

                                                        @foreach ($colors as $key=>$value)
                                                            @if ($key == $horoscope_score->dayscore)
                                                                <div class="day-block">
                                                                    <a style="font-size:10px; position: absolute;"> <?php echo date('d',strtotime($horoscope_score->day)); ?> </a>
                                                                    <a class="<?php echo date('D',strtotime($horoscope_score->day)); ?> t-size" style="color:{{$value}}">{{$horoscope_score->dayscore}}<a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                @endif
                                        @endforeach
                                            </div>
                                @endforeach
                            @else
                            <p><?php echo $error; ?></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@csrf
@endsection
