<?php

namespace App\Repository;

use App\Entity\Image;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

/**
 * @method user|null find($id, $lockMode = null, $lockVersion = null)
 * @method user|null findOneBy(array $criteria, array $orderBy = null)
 * @method user[]    findAll()
 * @method user[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    /**
     * ImageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct( ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }
}
