<?php

namespace App\Console\Commands;

use App\Mail\NotifyUser;
use App\Services\BitfinexService;
use App\Services\UserService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyUserBtcPrice extends Command
{
    protected  $bitfinexService;
    protected  $userService;

    public function __construct(
        BitfinexService $bitfinexService,
        UserService $userService,
    ) {
        $this->bitfinexService = $bitfinexService;
        $this->userService = $userService;
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:notify-user-btc-price';

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
        $highestBtcPrice = $this->getCurrentBtcPrice();
        $usersForNotifies = $this->getUsersForNotifies();

        foreach($usersForNotifies as $user)
        {
            if($highestBtcPrice >= $user->price_notified)
            {
                try {
                    Mail::to($user->email)->send(new NotifyUser( json_decode(json_encode($user), true)));
                    $this->setIsNotified($user->id,$user->price_notified);
                } catch (Exception $ex) {
                    dd($ex);
                }
            }
        }

        echo('Exec.time: ' . round((microtime(true) - $start), 2) . ' second(s)');
    }

    private function getUsersForNotifies()
    {
        return $this->userService->getUsersForNotifies();
    }

    private function getCurrentBtcPrice()
    {
        return $this->bitfinexService->getCurrentBtcPrice();
    }

    private function setIsNotified($userId,$userPriceNotified)
    {
        return $this->userService->setIsNotified($userId,$userPriceNotified);
    }
}
