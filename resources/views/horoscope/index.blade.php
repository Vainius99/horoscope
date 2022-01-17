@extends('layouts.app')

@section('content')

<div class="container">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#generateHoroscope">
        Generate Horoscope
    </button>
    <a class="btn btn-dark" href="{{ url('/calendors')}}"> Go to Calendar</a>
    <a style="position: absolute; left:75%; top:13%" href="{{ url('/horoscopes')}}"> Refresh </a>
    <h1>Horsocope years</h1>
    <div class="yearList">
    @if (!$horoscopes->isEmpty())
        <table class="table table-striped">
            <tr>
                <th> Years</th>
                <th> Action </th>
            </tr>
            @foreach ($horoscopes->sortBy('title') as $horoscope)
                <tr class="rowHoroscope">
                    <td class="list">{{$horoscope->title}}</td>
                    <td>
                        <form method="post" action="{{route('horoscope.destroy', [$horoscope]) }}">
                            <button class="btn btn-danger" type="submit">Delete </button>
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p class="note">There are no generated horoscopes</p>
    @endif
    </div>
</div>

<div class="modal fade" id="generateHoroscope" tabindex="-1" role="dialog" aria-labelledby="generateHoroscope" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Horoscope Generator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="horoscopeAjaxForm">
                <div class="form-group row">
                    <label for="horoscope_title" class="col-md-4 col-form-label text-md-right">{{ __('Type a Year from 2022 to 2100 ') }}</label>
                    <div class="col-md-6">
                        <input id="horoscope_title" type="text" class="form-control" name="horoscope_title">
                        <span class="invalid-feedback horoscope_title" role="alert"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <span> This may take couple of seconds to generate</span>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success addHoroscope">Add</button>
        </div>
      </div>
    </div>
    @csrf
</div>

<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });
        $(document).ready(function() {
        $(".addHoroscope").click(function() {
            var horoscope_title = $("#horoscope_title").val();
            $.ajax({
                type:'POST',
                url: '{{route("horoscope.storeAjax")}}',
                data: {horoscope_title:horoscope_title},
                success: function(data) {
                    if($.isEmptyObject(data.error)) {
                        $(".note").html('');
                        $(".invalid-feedback").css("display", 'none');
                        $("#generateHoroscope").modal("hide");
                        $(".yearList").append('<p class="list" style="font-size:20px; padding-right:20px;">New '+ horoscope_title +'</p> ');
                    } else {
                        $.each(data.error, function(key, error){
                            $(".invalid-feedback").css("display", 'block');
                            $(".invalid-feedback").html(error);
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
