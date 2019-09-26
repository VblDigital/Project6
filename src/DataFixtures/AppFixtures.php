<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->flush();
    }

    public function getDependencies ()
    {
    return array(
        UserFixtures::class,
        CategoryFixtures::class,
        TrickFixtures::class,
        CommentFixtures::class);
    }
}
