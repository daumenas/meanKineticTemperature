<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserFile;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\Collection;

class UserFileRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFile::class);
    }

    public function save(UserFile $userFile)
    {
        $this->saveEntity($userFile);
    }

    public function remove(UserFile $userFile)
    {
        $this->removeEntity($userFile);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): UserFile
    {
        return $this->findOneByOrFail(['id' => $id]);
    }
}