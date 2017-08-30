<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 21/04/2017
 * Time: 23:21
 */

namespace Warlof\Seat\SeatWeather\Http\Controllers;


use Seat\Web\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function getConfiguration()
    {
        return view('seat-weather::configuration');
    }

    public function postConfiguration()
    {
        $this->validate(request(), [
            'warlof-seat-weather-email' => 'required|email',
        ]);

        setting(['warlof.seat-weather.email', request()->input('warlof-seat-weather-email')], true);

        return redirect()
            ->back()
            ->with('success',
                trans('seat-weather::seat.config_edited') . request()->input('warlof-seat-weather-email'));
    }
}