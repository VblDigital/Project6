<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    /**
     * CommentRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct( ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param int $page
     * @param int $maxPerPage
     *
     * @return Paginator
     */
    public function findAllCommentsForPaginateAndSort($page, $maxPerPage)
    {
        if ($page <= 1) {
            $page = 1;
        }
        $commentsResults = ($page*$maxPerPage) - $maxPerPage;

        $query = $this->createQueryBuilder('c')
            ->orderBy('c.date', 'DESC')
            ->setFirstResult($commentsResults)
            ->setMaxResults($maxPerPage);

        $pagination = new Paginator($query);

        return $pagination;
    }
}
