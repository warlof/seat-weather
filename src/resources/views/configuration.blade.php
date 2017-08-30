@extends('web::layouts.grids.4-4-4')

@section('title', trans('seat-weather::seat.title'))
@section('page_header', trans('seat-weather::seat.configuration'));

@section('left')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('seat-weather::seat.configuration') }}</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ route('seat-weather.configuration.post') }}" method="post" class="form-horizontal">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="seat-weather-email" class="col-md-4">Mail Address</label>
                        <div class="input-group input-group-sm">
                            @if(setting('warlof.seat-weather.email', true) == null)
                            <input type="email" class="form-control" id="warlof-seat-weather-email"
                                   name="warlof-seat-weather-email" />
                            @else
                            <input type="email" class="form-control" id="warlof-seat-weather-email"
                                   name="warlof-seat-weather-email" value="{{ setting('warlof.seat-weather.email', true) }}" />
                            @endif
                        </div>
                        <span class="help-block">This mail address will be used by the job to send a notification when a package become outdated.</span>
                    </div>
                </div>

                <div class="box-footer">
                    <input type="submit" class="btn btn-primary pull-right" />
                </div>
            </form>
        </div>
    </div>
@stop