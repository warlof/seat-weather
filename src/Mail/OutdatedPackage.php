<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 23/04/2017
 * Time: 01:22
 */

namespace Warlof\Seat\SeatWeather\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OutdatedPackage extends Mailable
{
    use Queueable, SerializesModels;

    protected $packages;

    public function __construct(array $packages)
    {
        $this->packages = $packages;
    }

    public function build()
    {
        return view('seat-weather::email')
            ->with([
                'packages' => $this->packages,
                ]);
    }
}