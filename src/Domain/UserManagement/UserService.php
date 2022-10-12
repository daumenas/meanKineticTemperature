<?php

namespace App\Domain\UserManagement;

use App\Domain\UserManagement\Model\Entity\User;
use App\Domain\UserManagement\Model\Storage\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;

class UserService
{
    /** @required */
    public UserRepository $userRepository;

    public function __constructor(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIp(string $ipAddress): User
    {
        return $this->userRepository->findOneByIpOrFail($ipAddress);
    }
}