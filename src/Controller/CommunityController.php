<?php

namespace App\Controller;

use App\AppBundle\Doctrine\PaginationHelper;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommunityController
 * @package App\Controller
 */
class CommunityController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/page/{page}", name="list_page")
     */
    public function home(Request $request, $page=1)
    {
        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var TrickRepository $trickrepository */
        $trickrepository = $entityManager->getRepository(Trick::class);

        /** @var @ Query $query */
        $query = $trickrepository->findQueryForPagination();

        /** @var int $pages */
        $pages = PaginationHelper::getPagesCount($query);

        /** @var Trick[] $tricks */
        $tricks = PaginationHelper::paginate($query, 10, $page);

        return $this->render('community/home.html.twig', [
            'title' => "Salut les Snowboarders !",
            'page' => $page,
            'pages' => $pages,
            'tricks' => $tricks
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('community/login.html.twig', [
            'controller_name' => 'CommunityController',
        ]);
    }
}
