<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 30/08/2017
 * Time: 22:27
 */

namespace Warlof\Seat\SeatWeather\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['vendor', 'package', 'installed', 'latest'];
}
