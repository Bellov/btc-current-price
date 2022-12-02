<?php

namespace App\Http\Controllers;

use App\Services\BitfinexService;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected  $bitfinexservice;
    protected  $userService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BitfinexService $bitfinexService,
        UserService $userService,
    )
    {
        $this->bitfinexservice = $bitfinexService;
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $btcPrice = DB::table('cryptos')->get();

        $this->checkIfUserIsNotified($user->id);

        return view('home',
        [
            'btcPrice'       => $btcPrice,
            'user'           => $user,
            'notifiedStatus' => $this->checkIfUserIsNotified($user->id),
        ]);
    }

    private function checkIfUserIsNotified(int $userId)
    {
        return $this->userService->checkIfNotified($userId);
    }
}
