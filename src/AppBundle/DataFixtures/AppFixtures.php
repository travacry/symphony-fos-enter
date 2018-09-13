<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 13.09.2018
 * Time: 23:28
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $encoder = new BCryptPasswordEncoder(17);

        $user = new User();
        $user->setUsername('test2');
        $user->setPassword($encoder->encodePassword('asd123', false));
        $user->setEmail('asd@cc.ru');
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }
}