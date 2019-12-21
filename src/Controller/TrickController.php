<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\TrickType;
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
        if(!$trick) {
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

                $multipleImages = $trick->getImages();

                if($multipleImages != null) {
                    foreach ($multipleImages as $multipleImage)
                    {
                        $multipleFile = $multipleImage->getFile();
                        $trickImage_uploads_directory = $this->getParameter('trickImages_uploads_directory');
                        $trickImageFilename = md5(uniqid()) . '.' . $multipleFile->guessExtension();
                        $multipleFile->move(
                            $trickImage_uploads_directory,
                            $trickImageFilename
                        );
                        $multipleImage->setFilename($trickImageFilename);
                    }
                }

                $trick
                    ->setCreatedDate(new \DateTime())
                    ->setLastEditDate(new \DateTime())
                    ->setMainImageLink($filename)
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

                $mainFile = $request->files->get('trick')['mainImageLink'];
                $author = $trick->getAuthor();

                if ($mainFile != null & $this->getUser() == $author) {
                    $mainImage_uploads_directory = $this->getParameter('mainImage_uploads_directory');
                    $filename = md5(uniqid()) . '.' . $file->guessExtension();
                    $mainFile->move(
                        $mainImage_uploads_directory,
                        $filename);
                    $trick->setMainImageLink($filename);
                    $multipleImages = $trick->getImages();

                    if($multipleImages != null) {
                        foreach ($multipleImages as $multipleImage)
                        {
                            $file = $multipleImage->getFile();
                            $trickImage_uploads_directory = $this->getParameter('trickImages_uploads_directory');
                            $trickImageFilename = md5(uniqid()) . '.' . $file->guessExtension();
                            $file->move(
                                $trickImage_uploads_directory,
                                $trickImageFilename
                            );
                            $multipleImage->setFilename($trickImageFilename);
                        }
                    }

                    $manager->persist($trick);
                    $manager->flush();
                    return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
                } elseif ($mainFile == null) {
                    $multipleImages = $trick->getImages();

                    if(!$multipleImages->isEmpty()) {
                        foreach ($multipleImages as $multipleImage)
                        {
                            $multipleFile = $multipleImage->getFile();
                            if (null !== $multipleFile) {
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
                    return $this->redirectToRoute('view_trick', ['id' => $trick->getId()]);
                }
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
     * @Route("/trick/{id}", name="view_trick")
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
        $paginationLinks = $this->paginationHelper->getCommentUrl($page, $pages, $trick->getId());

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

        $images = $imageRepository->findBy(['trick' => $trick->getId()]);
        $videos = $videoRepository->findBy(['trick' => $trick->getId()]);

        return $this->render('community/viewTrick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'formComment' => $form->createView(),
            'paginationLinks' => $paginationLinks,
            'id' => $trick->getId(),
            'images' => $images,
            'video' => $videos
        ]);
    }
    /**
     * @Route("/trick/{id}/delete", name="delete_trick")
     */
    public function deleteTrick(Trick $trick = null, Request $request, ObjectManager $manager, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $trick = $em->getRepository(Trick::class)->find($id);

        if(!$trick) {
            $this->addFlash('notice', 'Ce Trick n\'existe pas.' );
            return $this->redirectToRoute('view_trick');
        }

        $em->remove($trick);
        $em->flush();
        return $this->redirectToRoute('home');
    }
}
