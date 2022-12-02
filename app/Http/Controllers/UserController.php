<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserNotifyRequest;
use App\Http\Requests\UserUnnotifyRequest;
use App\Repositories\CryptoRepository;
use App\Services\UserService;

class UserController extends Controller
{

    protected  $userService;
    protected $cryptoRepisotiry;

    public function __construct(
        UserService $userService,
        CryptoRepository $cryptoRepisotiry,
    )
    {
        $this->userService = $userService;
        $this->cryptoRepisotiry = $cryptoRepisotiry;
        $this->middleware('auth');
    }

    public function notify(UserNotifyRequest $request)
    {
        if(auth()->user()->email != $request['userEmail'])
        {
            return response()->json([ 'message' => 'Enter your email']);
        }

       $user = $this->userService->findUserByEmail($request['userEmail']);

       $dataArr = [
        'userId'              => $user->id,
        'priceNotified'       => $request['btcPrice'],
        'notify'              => $request['notify'],
       ];

    $notify =  $this->userService->notifyUser($dataArr);

    if($notify){
        return response()->json(
            [
             'message' => 'You will notify via email.'
            ]
          );
        }else{
            return response()->json(
                [
                 'message' => $notify
                ]
              );
        }
    }

    public function unnotify(UserUnnotifyRequest $request)
    {
        $user = $this->userService->findUserByEmail($request['userEmail']);
        $unnotify =  $this->userService->unnotifyUser($user->id);

        if($unnotify){
            return response()->json(
                [
                 'message' => 'You unnotify successful'
                ]
              );
            }else{
                return response()->json(
                    [
                     'message' => $unnotify
                    ]
            );
        }
    }
}
