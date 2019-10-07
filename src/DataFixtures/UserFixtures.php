<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load( ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('bobama')
            ->setPassword('12345')
            ->setEmail('bobama@usa.com')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('bobama', $user);

        $user = new User();
        $user
            ->setUsername('emacron')
            ->setPassword('54321')
            ->setEmail('emacron@france.fr')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('emacron', $user);

        $user = new user();
        $user
            ->setUsername('amerkel')
            ->setPassword('12345')
            ->setEmail('bobama@usa.com')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('amerkel', $user);

        $manager->flush();
    }
}
