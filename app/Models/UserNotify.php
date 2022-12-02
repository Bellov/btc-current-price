<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotify extends Model
{
    protected $table = 'users_notify';

    protected $fillable = [
        'user_id',
        'notify',
        'is_notified',
        'price_notified',
    ];
}
