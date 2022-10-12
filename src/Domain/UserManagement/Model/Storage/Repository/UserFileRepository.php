<?php

namespace App\Domain\UserManagement\Model\Storage\Repository;

use App\Domain\UserManagement\Model\Entity\UserFile;
use App\Repository\AbstractRepository;
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