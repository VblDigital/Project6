<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Comment;
use App\Entity\Video;
use App\Form\CommentType;
use App\Form\TrickType;
use App\Form\ImagesType;
use App\Form\VideosType;
use App\Repository\CommentRepository;
use App\Repository\ImageRepository;
use App\Repository\VideoRepository;
use App\Repository\TrickRepository;
use App\Service\Pagination\PaginationHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class TrickController
 * @package App\Controller
 */
class TrickController extends AbstractController
{
    private $paginationHelper;
    public function __construct (PaginationHelper $paginationHelper)
    {
        $this->paginationHelper = $paginationHelper;
    }
    /**
     * @Route("/newtrick", name="new_trick")
     * @Route("/trick/{id}/edit", name="edit_trick")
     * @Security("is_granted('ROLE_USER')")
     */
    public function trickForm(Trick $trick = null, Request $request, ObjectManager $manager)
    {
        if (!$trick) {
            $trick = new Trick();

            $form = $this->createForm(TrickType::class, $trick);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $mainFile = $request->files->get('trick')['mainImageLink'];
                $mainImage_uploads_directory = $this->getParameter('mainImage_uploads_directory');
                $filename = md5(uniqid()) . '.' . $mainFile->guessExtension();
                $mainFile->move(
                    $mainImage_uploads_directory,
                    $filename
                );

                $trick
                    ->setCreatedDate(new \DateTime())
                    ->setLastEditDate(new \DateTime())
                    ->setMainImageLink($filename)
                    ->setAuthor($this->getUser());
                $trick->setContributor($this->getUser());

                $manager->persist($trick);
                $manager->flush();

                return $this->redirectToRoute('view_trick', [
                    'slug' => $trick->getSlug()
                ]);
            }
        } else {
            $form = $this->createForm(TrickType::class, $trick);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $trick
                    ->setLastEditDate(new \DateTime())
                    ->setContributor($this->getUser());

                $mainFile = $request->files->get('trick')['mainImageLink'];
                $author = $trick->getAuthor();

                if (isset($mainFile) & $this->getUser() == $author) {
                    $mainImage_uploads_directory = $this->getParameter('mainImage_uploads_directory');
                    $filename = md5(uniqid()) . '.' . $mainFile->guessExtension();
                    $mainFile->move(
                        $mainImage_uploads_directory,
                        $filename);
                    $trick->setMainImageLink($filename);
                }

                $manager->persist($trick);
                $manager->flush();

                return $this->redirectToRoute('view_trick', [
                    'slug' => $trick->getSlug()
                ]);
            }
        }

        return $this->render('community/newTrick.html.twig', [
            'formTrick' => $form->createView(),
            'editMode' => $trick->getId() !== null,
            'link' => $trick->getMainImageLink(),
            'trick' => $trick
        ]);
    }

    /**
     * @Route("/trick/{slug}", name="view_trick")
     */
    public function viewTrick(Trick $trick = null, Request $request, ObjectManager $manager,
          CommentRepository $commentRepository, ImageRepository $imageRepository, VideoRepository $videoRepository)
    {
        $maxPerPage = 10;
        $page = (int) $request->query->get ('page', 1);

        $commentsCount = count($commentRepository->findAll());
        $pages = ceil($commentsCount/$maxPerPage);

        /** @var Trick [] */
        $comments = $commentRepository->findAllCommentsForPaginateAndSort($trick, $page, $maxPerPage);
        $paginationLinks = $this->paginationHelper->getCommentUrl($page, $pages, $trick->getSlug());

        $imagesForm = $this->createForm(ImagesType::class, $trick);
        $imagesForm->handleRequest($request);
        $videosForm = $this->createForm(VideosType::class, $trick);
        $videosForm->handleRequest($request);
        $comment = new Comment();
        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if ($imagesForm->isSubmitted() && $imagesForm->isValid()) {

            $multipleImages = $imagesForm['images']->getData();

            if (isset($multipleImages)) {
                foreach ($multipleImages as $multipleImage) {
                    $multipleFile = $multipleImage->getFile();
                    if ($multipleFile != null) {
                        $trickImage_uploads_directory = $this->getParameter('trickImages_uploads_directory');
                        $trickImageFilename = md5(uniqid()) . '.' . $multipleFile->guessExtension();
                        $multipleFile->move(
                            $trickImage_uploads_directory,
                            $trickImageFilename
                        );
                        $multipleImage->setFilename($trickImageFilename);
                    }
                }
            }

            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('view_trick', [
                'slug' => $trick->getSlug()
            ]);
        } elseif ($videosForm->isSubmitted() && $videosForm->isValid()) {

            $manager->persist($trick);
            $manager->flush();

            return $this->redirectToRoute('view_trick', [
                'slug' => $trick->getSlug()
            ]);
        } elseif ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setDate(new \DateTime())
                ->setTrick($trick)
                ->setUser($this->getUser());
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('view_trick', [
                'id' => $trick->getId(),
                'slug' => $trick->getSlug()
            ]);
        }

        $images = $imageRepository->findBy(['trick' => $trick->getId()]);
        $videos = $videoRepository->findBy(['trick' => $trick->getId()]);

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'formComment' => $commentForm->createView(),
            'formImages' => $imagesForm->createView(),
            'formVideos' => $videosForm->createView(),
            'paginationLinks' => $paginationLinks,
            'id' => $trick->getId(),
            'images' => $images,
            'videos' => $videos,
            'slug' => $trick->getSlug()
        ]);
    }
    /**
     * @Route("/trick/{id}/delete", name="delete_trick")
     */
    public function deleteTrick(Trick $trick = null, Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $trick = $em->getRepository(Trick::class)->find($id);

        if(!$trick) {
            $this->addFlash('notice', 'Ce Trick n\'existe pas.' );
            return $this->redirectToRoute('home');
        }
        $comments = $em->getRepository(Comment::class)->findBy(['trick' => $trick->getId()]);
        foreach ($comments as $comment){
            $em->remove($comment);
        }
        $em->remove($trick);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
