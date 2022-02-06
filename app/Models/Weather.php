<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Weather
 * 
 * @property int $id
 * @property int $locale_id
 * @property Carbon $date
 * @property string $text
 * @property int $temperature_min
 * @property int $temperature_max
 * @property int $rain_probability
 * @property int $rain_precipitation
 * 
 * @property Locale $locale
 *
 * @package App\Models
 */
class Weather extends Model
{
    protected $table = 'weather';
    public $timestamps = false;
    public static $snakeAttributes = false;

    protected $casts = [
        'locale_id' => 'int',
        'temperature_min' => 'int',
        'temperature_max' => 'int',
        'rain_probability' => 'int',
        'rain_precipitation' => 'int'
    ];

    protected $dates = [
        'date'
    ];

    protected $hidden = [
        'locale_id'
    ];

    protected $fillable = [
        'locale_id',
        'date',
        'text',
        'temperature_min',
        'temperature_max',
        'rain_probability',
        'rain_precipitation'
    ];

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }
}
