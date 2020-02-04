<?php

namespace App\DataFixtures;

use App\Entity\Foto;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin5@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'password'
        ));
        $user->setRoles(['ROLE_ADMIN']);

        $foto = new Foto();
        $foto->setTitel('Titel');
        $foto->setBeschrijving('safageewgweg');
        $foto->setFileurl('346387u892f.jpg');
        $foto->setUser($user);
        $manager->persist($foto);


        $manager->persist($user);
        $manager->flush();
    }
}
