<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected  $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function findUserByEmail(string $userEmail)
    {
       return  $this->userRepository->findByEmail($userEmail);
    }

    public function notifyUser(array $data)
    {
        return $this->userRepository->notifyUser($data);
    }

    public function unnotifyUser(int $userId)
    {
        return $this->userRepository->unnotifyUser($userId);
    }

    public function checkIfNotified(int $userId)
    {
        return $this->userRepository->checkIfNotified($userId);
    }

    public function getUsersForNotifies()
    {
        return $this->userRepository->getUsersForNotifies();
    }

    public function setIsNotified($userId,$userPriceNotified)
    {
        return $this->userRepository->setIsNotified($userId,$userPriceNotified);
    }
}
