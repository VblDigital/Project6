<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrickFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $trick = new Trick();
        $trick->setId("1")->setName("Le Mute")->setDescription("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("2")->setName("Le Style Week")->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setImageLink("http://placehold.it/350X150")->setUserId(3)->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("3")->setName("L'Indy ")->setDescription("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")->setImageLink("http://placehold.it/350X150")->setUserId(2)->setChapo("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("4")->setName("Le Stalefish ")->setDescription("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("5")->setName("Le Tail Grab")->setDescription("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")->setImageLink("http://placehold.it/350X150")->setUserId(5)->setChapo("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("6")->setName("Le Nose Grab")->setDescription("Grab avec saisie de la partie avant de la planche, avec la main avant.")->setImageLink("http://placehold.it/350X150")->setUserId(2)->setChapo("Grab avec saisie de la partie avant de la planche, avec la main avant.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("7")->setName("Le Japan Air")->setDescription("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")->setImageLink("http://placehold.it/350X150")->setUserId(5)->setChapo("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("8")->setName("Le Seat Belt")->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("9")->setName("Le Truck Driver")->setDescription("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")->setImageLink("http://placehold.it/350X150")->setUserId(4)->setChapo("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")->setCategoryId("1");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("10")->setName("La rotation 180")->setDescription("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")->setCategoryId("2");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("11")->setName("La rotation trois six")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")->setImageLink("http://placehold.it/350X150")->setUserId(4)->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")->setCategoryId("2");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("12")->setName("La rotation cinq quatre")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")->setImageLink("http://placehold.it/350X150")->setUserId(5)->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")->setCategoryId("2");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("13")->setName("La rotation sept deux")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")->setCategoryId("2");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("14")->setName("La rotation 900")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")->setImageLink("http://placehold.it/350X150")->setUserId(2)->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")->setCategoryId("2");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setId("15")->setName("La rotation Big Foot")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")->setImageLink("http://placehold.it/350X150")->setUserId(1)->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")->setCategoryId("2");
        $manager->persist($trick);

        $manager->flush();
    }
}
