<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 22/04/2017
 * Time: 23:05
 */

namespace Warlof\Seat\SeatWeather\Helpers;


class Composer extends \Illuminate\Support\Composer
{
    public function getOutdatedPackages()
    {
        $process = $this->getProcess($extra = '');

        $process->setCommandLine(trim($this->findComposer() . ' outdated' . $extra));

        $process->run();

        $output = $process->getOutput();

        $lines = explode("\n", $output);

        $packages = [];

        foreach ($lines as $line) {
            $packages[] = $this->columnValues($line);;
        }

        //logger()->debug('Outdated Packages Informations', $packages);
    }

    private function columnValues(string $line)
    {
        $package = [];

        // get first space character occurrence which mark the end of package column
        $columnEnd = strpos($line, ' ');

        // store the package value
        $packagist = substr($line, 0, $columnEnd);

        $package['vendor'] = substr($packagist, 0, strpos($packagist, '/'));
        $package['package'] = substr($packagist, strpos($packagist, '/') + 1);

        // remove the package from the line and any leading space
        $line = ltrim(substr($line, $columnEnd));

        // get first space character occurrence which mark the end of installed version column
        $columnEnd = strpos($line, ' ');
        // store the installed version value
        $package['installed'] = substr($line, 0, $columnEnd);
        // remove the installed version from the line and any leading space
        $line = ltrim(substr($line, $columnEnd));

        // get first space character occurrence which mark the end of latest version column
        $columnEnd = strpos($line, ' ');
        // store the latest version from the line
        $package['latest'] = substr($line, 0, $columnEnd);

        return $package;
    }
}