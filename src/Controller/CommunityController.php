<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Service\Pagination\PaginationHelper;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class CommunityController
 * @package App\Controller
 */
class CommunityController extends AbstractController
{
    /**
     * @var PaginationHelper
     */
    private $paginationHelper;

    public function __construct (PaginationHelper $paginationHelper)
    {
        $this->paginationHelper = $paginationHelper;
    }

    /**
     * @Route("/", name="home")
     */
    public function home (Request $request, TrickRepository $trickRepository)
    {
        $maxPerPage = 10;
        $page = (int) $request->query->get ('page', 1);

        $tricksCount = count($trickRepository->findAll());
        $pages = ceil($tricksCount/$maxPerPage);

        /** @var Trick [] */
        $tricks = $trickRepository->findAllForPaginateAndSort($page, $maxPerPage);
//        $paginationLinks = $this->paginationHelper->getUrl($page, $pages);

        return $this->render('community/home.html.twig', [
//            'paginationLinks' => $paginationLinks,
            'tricks' => $tricks
        ]);
    }
}
