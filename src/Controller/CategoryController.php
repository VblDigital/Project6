<?php


namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends CommunityController
{
    /**
     * @Route("/newcategory", name="new_category")
     * @Route("/category/{id}/edit", name="edit_category")
     */
    public function categoryForm(Category $category, Request $request, ObjectManager $manager)
    {
        if(!$category){
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('view_categories', ['id' => $category->getId()]);
        }

        return $this->render('community/newCategory.html.twig', [
            'formCategory' => $form->createView(),
            'editMode' => $category->getId() !== null
        ]);
    }

    /**
     * @Route("/categories", name="view_categories")
     */
    public function viewCategories()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $category = $repo->findAll();

        return $this->render('community/viewCategories.html.twig', [
            'category' => $category
        ]);
    }
}
