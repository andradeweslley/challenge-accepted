<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalAccessToken
 * 
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property string|null $abilities
 * @property Carbon|null $last_used_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class PersonalAccessToken extends Model
{
    protected $table = 'personal_access_tokens';
    public static $snakeAttributes = false;

    protected $casts = [
        'tokenable_id' => 'int'
    ];

    protected $dates = [
        'last_used_at'
    ];

    protected $hidden = [
        'tokenable_id',
        'token'
    ];

    protected $fillable = [
        'tokenable_type',
        'tokenable_id',
        'name',
        'token',
        'abilities',
        'last_used_at'
    ];
}
