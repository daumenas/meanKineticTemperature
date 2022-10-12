<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

abstract class AbstractRepository extends ServiceEntityRepository
{
//    /** @required */
//    private EntityManagerInterface $entityManager;
//
//    public function setEntityManager(EntityManagerInterface $entityManager): void
//    {
//        $this->entityManager = $entityManager;
//    }
    /**
     * @throws EntityNotFoundException
     */
    protected function findOneByOrFail(array $criteria)
    {
        $result = $this->findOneBy($criteria);

        if (is_null($result)) {
            throw new EntityNotFoundException();
        }

        return $result;
    }

    protected function saveEntity($entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    protected function removeEntity($entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}