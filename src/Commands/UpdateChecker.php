<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 22/04/2017
 * Time: 00:50
 */

namespace Warlof\Seat\SeatWeather\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Seat\Eveapi\Helpers\JobPayloadContainer;
use Seat\Eveapi\Traits\JobManager;
use Seat\Services\Helpers\AnalyticsContainer;
use Seat\Services\Jobs\Analytics;
use Warlof\Seat\SeatWeather\Helpers\Composer;
use Warlof\Seat\SeatWeather\Mail\OutdatedPackage;

class UpdateChecker extends Command
{
    use JobManager;

    protected $signature = 'seat:weather:check';

    protected $description = 'Check installed package version and send a mail to a notification mail address if they are outdated.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(JobPayloadContainer $job)
    {
        $composer = new Composer(app('files'), app()->basePath());
        $packages = $composer->getOutdatedPackages();

        if (count($packages)) {

            //Mail::send(new OutdatedPackage($packages));
            Mail::send('seat-weather::email', ['packages' => $packages], function($m){
                $m->to(setting('warlof.seat-weather.email'), 'Warlof Tutsimo') // TODO : mail notification settings, use SeAT mail ?
                    ->subject('Outdated SeAT Instance');
            });

        }

        $this->line('done');
        /*
        $job->api = 'seat';
        $job->scope = 'monitoring';
        $jobId = $this->addUniqueJob(\Warlof\Seat\SeatWeather\Jobs\UpdateChecker::class, $job);

        dispatch(
            (new Analytics(
                (new AnalyticsContainer())
                    ->set('type', 'event')
                    ->set('ec', 'queues')
                    ->set('ea', 'seat:weather:check')
                    ->set('el', 'console')
                    ->set('ev', 1)
                ))->onQueue('medium'));
        */
    }
}