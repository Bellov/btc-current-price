<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository
{

    public function findByEmail(string $userEmail)
    {
       return  DB::table('users')->where('email', $userEmail)->first();
    }

    public function notifyUser(array $data)
    {
       return  DB::table('users_notify')->insert(
            [
                'user_id'           => $data['userId'],
                'notify'            => $data['notify'],
                'price_notified'    => $data['priceNotified'],
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        );
    }

    public function unnotifyUser($userId)
    {
    return DB::table('users_notify')
          ->where('user_id', $userId)
          ->latest('created_at')->limit(1)->update(['notify' => 0, 'is_notified' => 0]);
    }

    public function checkIfNotified(int $userId): bool
    {
        $check =  DB::table('users_notify')
            ->select('notify')
            ->where('user_id', $userId)
            ->latest('created_at')->first();

       return $check->notify ?? 0;
    }

    public function getUsersForNotifies()
    {
        return DB::table('users_notify')
            ->select('users_notify.price_notified', 'users.email','users.id')
            ->join('users', 'users.id', '=', 'users_notify.user_id')
            ->where('users_notify.notify', 1)
            ->where('users_notify.is_notified', 0)
            ->get();
    }

    public function setIsNotified($userId,$userPriceNotified)
    {
       return DB::table('users_notify')
            ->where('user_id', $userId)
            ->where('price_notified', $userPriceNotified)
            ->update(['is_notified' => 1]);
    }
}
