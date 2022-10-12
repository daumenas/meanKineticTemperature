<?php

namespace App\Service;

use App\Repository\UserFileRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;

class UserService
{
    private UserRepository $userRepository;

    public function __constructor(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIp(float $ipAddress): Collection
    {
        return $this->userRepository->findOneByIpOrFail($ipAddress);
    }
}