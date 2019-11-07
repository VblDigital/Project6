<?php

namespace App\Service;

use Symfony\Component\Routing\RouterInterface;

class PaginationHelper
{
    private $routerInterface;

    public function __construct(RouterInterface $routerInterface) {

        $this->routerInterface = $routerInterface;
    }

    /**
     * @param $page
     * @param $pages
     * @return array
     */
    public function getUrl ($page, $pages)
    {
        $router = $this->router;

        $paginationLinks = array(
            'page' => $page,
            'pages' => $pages,
            'firstPage' => $router->generate('home', ['page' => '1']),
            'lastPage' => $router->generate('home', ['page' => $pages]),
            'nextPage' => $router->generate('home', ['page' => ($page + 1)]),
            'previousPage' => $router->generate('home', ['page' => ($page - 1)])
        );

        return $paginationLinks;
    }
}
