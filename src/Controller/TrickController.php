<?php


namespace App\Controller;

use App\AppBundle\Doctrine\PaginationHelper;
use App\Entity\Trick;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Repository\TrickRepository;
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
     * @Route("/trick/{id}/page/{page}", name="comment_list_page")
     */
    public function viewTrick(Trick $trick = null, Request $request, ObjectManager $manager, $page=1)
    {
        /** @var EntityManager $em */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var CommentRepository $commentRepository */
        $commentRepository = $entityManager->getRepository(Comment::class)->findBy(['trick' => $trick] );

        /** @var @ Query $query */
        $query = $commentRepository->findQueryForCommentPagination();

        /** @var int $pages */
        $pages = PaginationHelper::getPagesCount($query);

        /** @var Comment[] $comments */
        $comments = PaginationHelper::paginate($query, 10, $page);

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

            return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
        }

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick,
            'page' => $page,
            'pages' => $pages,
            'comments' => $comments,
            'formComment' => $form->createView(),
            'id' => $trick->getId()
        ]);
    }
}
