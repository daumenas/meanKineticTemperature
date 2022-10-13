<?php

namespace App\Domain\FileManagement\Model\Storage\Repository;

use App\Domain\FileManagement\Model\Entity\File;
use App\Domain\UserManagement\Model\Entity\User;
use App\Repository\AbstractRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class FileRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, File::class);
    }

    public function save(File $file)
    {
        $this->saveEntity($file);
    }

    public function remove(File $file)
    {
        $this->removeEntity($file);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): File
    {
        return $this->findOneByOrFail(['id' => $id]);
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findOneByIpOrFail(float $ip): User
    {
        return $this->findOneByOrFail(['ipAddress' => $ip]);
    }
}