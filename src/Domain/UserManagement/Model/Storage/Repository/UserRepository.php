<?php

namespace App\Domain\UserManagement\Model\Storage\Repository;

use App\Domain\UserManagement\Model\Entity\User;
use App\Repository\AbstractRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user)
    {
        $this->saveEntity($user);
    }

    public function remove(User $user)
    {
        $this->removeEntity($user);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): User
    {
        return $this->findOneByOrFail(['id' => $id]);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIpOrFail(string $ip): User
    {
        return $this->findOneByOrFail(['ipAddress' => $ip]);
    }
}