<?php


namespace App\AppBundle\Doctrine;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PaginationHelper
{
    /**
     * @param Query $query
     * @param int $maxPage
     * @return int
     */
    public static function getPagesCount(Query $query, $maxPage = 10)
    {
        $paginator = new Paginator($query);

        return ceil($paginator->count() / $maxPage);
    }

    /**
     * @param Query $query
     * @param int $maxPage
     * @param int $currentPage
     * @return array
     */
    public static function paginate(Query $query, $maxPage = 10, $currentPage = 1)
    {
        $maxPage = (int)$maxPage;
        $currentPage = (int)$currentPage;

        if ($maxPage < 1) {
            $maxPage = 10;
        }

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $paginator = new Paginator($query);

        $results = $paginator
            ->getQuery()
            ->setFirstResult($maxPage * ($currentPage - 1))
            ->setMaxResults($maxPage)
            ->getResult();

        return $results;
    }
}