<?php

namespace App\Models;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Locale
 * 
 * @property int $id
 * @property string $name
 * @property string $state
 * @property string $latitude
 * @property string $longitude
 * 
 * @property Collection|Weather[] $weather
 *
 * @package App\Models
 */
class Locale extends Model
{
    use Searchable;

    protected $table = 'locales';
    public $timestamps = false;
    public static $snakeAttributes = false;

    protected $fillable = [
        'name',
        'state',
        'latitude',
        'longitude'
    ];

    public function weather()
    {
        return $this->hasMany(Weather::class);
    }
}
