<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Model
{
    protected $fillable = [
        'email',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
