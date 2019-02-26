<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersFixtures extends Fixture

{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setNom('BEC');
        $user->setEmail('pouned@gmail.com');
        $user->setPrenom('Edwin');
        $user->setTel('0658231423');
        $user->setService('Direction');
        $user->setRoles(['ROLE_ADMIN']);

        $password = $this->encoder->encodePassword($user, '123');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
