<?php

namespace App\Repositories;

use App\Models\Crypto;
use Illuminate\Support\Facades\DB;

class CryptoRepository
{
    public function storeData($data)
    {
        $crypto = new Crypto();
        $crypto->mid = $data->mid;
        $crypto->bid = $data->bid;
        $crypto->ask = $data->ask;
        $crypto->last_price= $data->last_price;
        $crypto->high = $data->high;
        $crypto->low = $data->low;
        $crypto->volume = $data->volume;
        $crypto->timestamp =(date('Y-m-d H:i:s', $data->timestamp));
        $crypto->save();

        return $crypto;
    }

    public function getBtcPrice()
    {
        return DB::table('cryptos')->last();
    }

    public function getCurrentBtcPrice()
    {
        return DB::table('cryptos')
            ->select('high as current_last_highest_btc_price')
            ->latest('created_at')->first()
            ->{'current_last_highest_btc_price'};
    }
}
