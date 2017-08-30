<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 22/04/2017
 * Time: 23:05
 */

namespace Warlof\Seat\SeatWeather\Helpers;


use Illuminate\Support\Collection;
use Warlof\Seat\SeatWeather\Models\Package;

class Composer extends \Illuminate\Support\Composer
{
    //public function getOutdatedPackages() : array
    public function getOutdatedPackages() : Collection
    {
        $process = $this->getProcess();

        $process->setCommandLine(trim($this->findComposer() . ' outdated --direct'));

        $process->run();

        $output = $process->getOutput();

        $lines = explode("\n", $output);

        $packages = [];

        foreach ($lines as $line) {
            $packages[] = $this->columnValues($line);;
        }

        return collect($packages);
    }

    //private function columnValues(string $line) : array
    private function columnValues(string $line) : Package
    {
        /*
        $package = [
            'vendor' => '',
            'package' => '',
            'installed' => '',
            'latest' => ''
        ];
        */
        $package = new Package();

        // get first space character occurrence which mark the end of package column
        $columnEnd = strpos($line, ' ');

        // store the package value
        $packagist = substr($line, 0, $columnEnd);

        //$package['vendor'] = substr($packagist, 0, strpos($packagist, '/'));
        $package->vendor = substr($packagist, 0, strpos($packagist, '/'));
        //$package['package'] = substr($packagist, strpos($packagist, '/') + 1);
        $package->package = substr($packagist, strpos($packagist, '/') + 1);

        // remove the package from the line and any leading space
        $line = ltrim(substr($line, $columnEnd));

        // get first space character occurrence which mark the end of installed version column
        $columnEnd = strpos($line, ' ');
        // store the installed version value
        //$package['installed'] = substr($line, 0, $columnEnd);
        $package->installed = substr($line, 0, $columnEnd);
        // remove the installed version from the line and any leading space
        $line = ltrim(substr($line, $columnEnd));

        // store the latest version from the line
        if (preg_match_all('/^(~?!? )?(v?[0-9.]+)([a-z0-9A-Z .|\-+])+$/', $line, $matches) === 1)
            //$package['latest'] = $matches[2][0];
            $package->latest = $matches[2][0];

        return $package;
    }
}