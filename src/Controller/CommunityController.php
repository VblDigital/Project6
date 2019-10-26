<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CommunityController
 * @package App\Controller
 */
class CommunityController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/page={page}", name="list_page")
     */
    public function home ($page=1)
    {
        $maxPerPage = 10;
        $route = 'list_page';

        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var TrickRepository $trickRepository */
        $trickRepository = $entityManager->getRepository(Trick::class);

        /** @var int $tricksCount */
        $tricksCount = count($trickRepository->findAll());

        /** @var int $pages */
        $pages = ceil($tricksCount/$maxPerPage);

        /** @var @ Tricks [] */
        $tricks = $trickRepository->findAllForPaginateAndSort($page, $maxPerPage);

        $paginationLinks = array(
            'firstPage' => 1,
            'lastPage' => $pages,
        );

        return $this->render('community/home.html.twig', [
            'pages' => $pages,
            'page' => $page,
            'tricks' => $tricks,
            'paginationLinks' => $paginationLinks,
            'route' => $route
        ]);
    }
}