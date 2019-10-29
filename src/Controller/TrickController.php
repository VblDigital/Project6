<?php


namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\CommentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class TrickController
 * @package App\Controller
 */
class TrickController extends CommunityController
{
    /**
     * @Route("/newtrick", name="new_trick")
     * @Route("/trick/{id}/edit", name="edit_trick")
     * @Security("is_granted('ROLE_USER')")
     */
    public function trickForm(Trick $trick = null, Request $request, ObjectManager $manager)
    {
        if(!$trick) {
            $trick = new Trick();

            $form = $this->createForm(TrickType::class, $trick);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $trick
                    ->setLastEditDate(new \DateTime())
                    ->setAuthor($this->getUser());
                $trick->setContributor($this->getUser());

                $manager->persist($trick);
                $manager->flush();

                return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
            }
        }

        else {
            $form = $this->createForm(TrickType::class, $trick);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $trick
                    ->setLastEditDate(new \DateTime())
                    ->setContributor($this->getUser());

                $manager->persist($trick);
                $manager->flush();

                return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
            }
        }

        return $this->render('community/newTrick.html.twig', [
            'formTrick' => $form->createView(),
            'editMode' => $trick->getId() !== null
        ]);
    }

    /**
     * @Route("/trick/{id}", name="view_trick")
     */
    public function viewTrick(Trick $trick = null, Request $request, ObjectManager $manager)
    {
        $maxPerPage = 10;
        $route = 'view_trick';
        $id = $trick->getId();
        $page = (int) $request->query->get ('page', 1);

        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var CommentRepository $commentRepository */
        $commentRepository = $entityManager->getRepository(Comment::class);

        $commentsCount = count($commentRepository->findAll());
        $pages = ceil($commentsCount/$maxPerPage);

        /** @var Trick [] */
        $comments = $commentRepository->findAllCommentsForPaginateAndSort($page, $maxPerPage);

        $repo = $this->getDoctrine()->getRepository(Trick::class);
        $trick = $repo->find($trick->getId());

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                    ->setTrick($trick)
                    ->setUser($this->getUser());

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('view_trick', ['id' => $id]);
        }

        $paginationLinks = array(
            'firstPage' => '1',
            'lastPage' => $pages,
            'nextPage' => ($page + 1),
            'previousPage' => ($page -1)
        );

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick,
            'page' => $page,
            'pages' => $pages,
            'comments' => $comments,
            'formComment' => $form->createView(),
            'paginationLinks' => $paginationLinks,
            'id' => $id,
            'route' => $route
        ]);
    }
}
