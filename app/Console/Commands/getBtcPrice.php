<?php

namespace App\Console\Commands;

use App\Services\BitfinexService;
use Illuminate\Console\Command;

class getBtcPrice extends Command
{
    protected  $bitfinexService;

    public function __construct(
        BitfinexService $bitfinexService
    ) {
        $this->bitfinexService = $bitfinexService;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-btc-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get current BTC price from Bitfinex';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = microtime(true);
        $this->bitfinexService->storeData($this->getData());

        echo('Exec.time: ' . round((microtime(true) - $start), 2) . ' second(s)');
    }

    private function getData()
    {
       return $this->bitfinexService->getData();
    }
}
