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
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class CommunityController
 * @package App\Controller
 */
class CommunityController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home (Request $request, Router $router)
    {
        $maxPerPage = 10;
        $page = (int) $request->query->get ('page', 1);

        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var TrickRepository $trickRepository */
        $trickRepository = $entityManager->getRepository(Trick::class);

        $tricksCount = count($trickRepository->findAll());
        $pages = ceil($tricksCount/$maxPerPage);

        /** @var Trick [] */
        $tricks = $trickRepository->findAllForPaginateAndSort($page, $maxPerPage);

        $paginationHelper = new PaginationHelper();
        dd($paginationHelper->getUrl($router, $page, $pages));

        return $this->render('community/home.html.twig', [
            'paginationHelper' => $paginationHelper,
            'tricks' => $tricks
        ]);
    }
}
