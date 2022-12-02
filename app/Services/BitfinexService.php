<?php

namespace App\Services;

use App\Repositories\CryptoRepository;

class BitfinexService
{
    protected  $cryptoRepository;

    public function __construct(
        CryptoRepository $cryptoRepository
    ) {
        $this->cryptoRepository = $cryptoRepository;
    }

    public function getData()
    {
        $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL =>config('bitfinex.url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "accept: application/json"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            return json_decode($response);
            }
    }

    public function storeData($data)
    {
        $this->cryptoRepository->storeData($data);
    }

    public function getBtcPrice()
    {
        $this->cryptoRepository->getBtcPrice();
    }

    public function getCurrentBtcPrice()
    {
       return $this->cryptoRepository->getCurrentBtcPrice();
    }
}
