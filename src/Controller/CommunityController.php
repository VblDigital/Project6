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
     */
    public function home (Request $request)
    {
        $maxPerPage = 10;
        $route = 'home';
        $page = (int) $request->query->get ('page', 1);

        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var TrickRepository $trickRepository */
        $trickRepository = $entityManager->getRepository(Trick::class);

        $tricksCount = count($trickRepository->findAll());
        $pages = ceil($tricksCount/$maxPerPage);

        /** @var Trick [] */
        $tricks = $trickRepository->findAllForPaginateAndSort($page, $maxPerPage);

        $paginationLinks = array(
            'firstPage' => '1',
            'lastPage' => $pages,
            'nextPage' => ($page + 1),
            'previousPage' => ($page -1)
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
