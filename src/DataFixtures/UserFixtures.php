<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 * @property UserPasswordEncoderInterface encoder
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load( ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('bobama')
            ->setPassword($this->encoder->encodePassword($user, '12345'))
            ->setEmail('bobama@usa.com')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('bobama', $user);

        $user = new User();
        $user
            ->setUsername('emacron')
            ->setPassword($this->encoder->encodePassword($user, '54321'))
            ->setEmail('emacron@france.fr')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('emacron', $user);

        $user = new user();
        $user
            ->setUsername('amerkel')
            ->setPassword($this->encoder->encodePassword($user, '12345'))
            ->setEmail('bobama@usa.com')
            ->setNewPass('0');
        $manager->persist($user);
        $this->addReference('amerkel', $user);

        $manager->flush();
    }
}
