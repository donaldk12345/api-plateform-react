<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
     
        
        $user = new User();
        $user->setUsername("nono");
        $user->setEmail("nono@gmail.com");
        $user->setPassword($this->encoder->encodePassword($user, "nono12345"));
        $manager->persist($user);
        $manager->flush();
    }
}
