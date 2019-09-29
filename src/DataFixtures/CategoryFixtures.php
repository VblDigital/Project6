<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CategoryFixtures
 * @package App\DataFixtures
 */
class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load( ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Les Grabs");
        $manager->persist($category);
        $this->addReference("cat1", $category);

        $category = new Category();
        $category->setName("Les Rotations");
        $manager->persist($category);
        $this->addReference("cat2", $category);

        $manager->flush();
    }
}
