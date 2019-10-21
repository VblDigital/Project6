<?php

namespace App\Controller;

use App\AppBundle\Doctrine\PaginationHelper;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function home($page=1)
    {
        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var TrickRepository $trickRepository */
        $trickRepository = $entityManager->getRepository(Trick::class);

        /** @var @ Query $query */
        $query = $trickRepository->findQueryForTrickPagination();

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
}
