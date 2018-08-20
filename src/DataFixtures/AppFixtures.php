<?php
namespace App\DataFixtures;

use App\Entity\MicroPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @var UserPasswordEncoderInterface
 */
//private $passwordEncoder;

//public function __construct(UserPasswordEncoderInterface $passwordEncoder)
//{
//    $this->passwordEncoder = $passwordEncoder;
//}

class AppFixtures extends Fixture
{
    public  function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++){
            $timeLog = new TimeLog();
            $timeLog->setText('Some Random text' .rand(0, 100));
            $timeLog->setTime(new \DateTime('2018-07-05'));
            $manager->persist($timeLog);
        }
        $manager->flush();
    }

    private function loadUsers (ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('ranga');
        $user->setFullName('ranga mahesh');
        $user->setEmail('rangam.sl@gmail.com');
        $user->setFullName(
            $this->passwordEncoder->encodePassword(
                $user,
                'ranga123'
            )
        );
        $manager->persist($user);
        $manager->flush();
    }

}