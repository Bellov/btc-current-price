<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'cryptos';

    protected $guarded = [
        'mid',
        'bid',
        'ask',
        'last_price',
        'low',
        'high',
        'volume',
        'timestamp'
    ];
}
