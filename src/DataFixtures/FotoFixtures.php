<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Foto;
use Symfony\Component\Security\Core\User\UserInterface;

class FotoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $foto = new Foto();
        // $foto->setTitel('titel');
        // $foto->setBeschrijving('beschrijving');
        // $foto->setFileUrl('0d2f23979078f217f29827ae0d57c2f0.jpeg');
        // $foto->setUser(1);
        // $manager->persist($foto);
        // $manager->flush();
    }
}
