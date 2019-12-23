<?php

namespace App\Repository;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

/**
 * @method image|null find($id, $lockMode = null, $lockVersion = null)
 * @method image|null findOneBy(array $criteria, array $orderBy = null)
 * @method image[]    findAll()
 * @method image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
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
