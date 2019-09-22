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
        $trick->setName("Le Mute")->setDescription("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la carre frontside de la planche entre les deux pieds avec la main avant.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Style Week")->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("L'Indy ")->setDescription("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Stalefish ")->setDescription("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la carre backside de la planche entre les deux pieds avec la main arrière.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Tail Grab")->setDescription("Grab avec saisie de la partie arrière de la planche, avec la main arrière.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la partie arrière de la planche, avec la main arrière.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Nose Grab")->setDescription("Grab avec saisie de la partie avant de la planche, avec la main avant.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la partie avant de la planche, avec la main avant.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Japan Air")->setDescription("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Seat Belt")->setDescription("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("Le Truck Driver")->setDescription("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Grab avec saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation 180")->setDescription("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation » horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 180 degrés d'angle.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation trois six")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 360 degrés d'angle, soit un tour complet.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation cinq quatre")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 540 degrés d'angle, soit un tour et demi.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation sept deux")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit deux tours complets.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation 900")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 900 degrés d'angle, soit deux tours et demi.");
        $manager->persist($trick);

        $trick = new Trick();
        $trick->setName("La rotation Big Foot")->setDescription("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.")->setUserId(1)->setImageLink("http://placehold.it/350X150")->setChapo("Une rotation horizontale executée pendant le saut, avec atterrissage en position switch ou normal et d'une rotation de 720 degrés d'angle, soit trois tours complets.");
        $manager->persist($trick);

        $manager->flush();
    }
}
