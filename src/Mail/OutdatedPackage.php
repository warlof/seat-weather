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
use Illuminate\Support\Collection;

class OutdatedPackage extends Mailable
{
    use Queueable, SerializesModels;

    public $packages;

    public function __construct(Collection $packages)
    {
        $this->packages = $packages;
    }

    public function build()
    {
        return $this->view('seat-weather::email');
    }
}