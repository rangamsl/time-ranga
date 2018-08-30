<?php
namespace App\DataFixtures;

use App\Entity\Time;
use App\Entity\User;
use App\Entity\UserPreferences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
//{
//    public  function load(ObjectManager $manager)
//    {
//        for ($i = 0; $i < 10; $i++){
//            $timeLog = new TimeLog();
//            $timeLog->setText('Some Random text' .rand(0, 100));
//            $timeLog->setTime(new \DateTime('2018-07-05'));
//            $manager->persist($timeLog);
//        }
//        $manager->flush();
//    }
//
//    private function loadUsers (ObjectManager $manager)
//    {
//        $user = new User();
//        $user->setUsername('ranga');
//        $user->setFullName('ranga mahesh');
//        $user->setEmail('rangam.sl@gmail.com');
//        $user->setFullName(
//            $this->passwordEncoder->encodePassword(
//                $user,
//                'ranga123'
//            )
//        );
//        $manager->persist($user);
//        $manager->flush();
//    }
//
//}

{
    private const USERS = [
        [
            'username' => 'ranga',
            'email' => 'rangam.sl@gmail.com',
            'password' => 'ranga123',
            'fullName' => 'Ranga Mahesh',
            'roles' => [User::ROLE_USER]
        ],
        [
            'username' => 'mahesh',
            'email' => 'mahesh.sl@gmail.com',
            'password' => 'mahesh123',
            'fullName' => ' Mahesh Kumara',
            'roles' => [User::ROLE_USER]
        ],
        [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'fullName' => 'Admin  Mahesh Kumara',
            'roles' => [User::ROLE_ADMIN]
        ],
    ];

    private const POST_TEXT = [
        'Hello, how are you?',
        'It\'s nice sunny weather today',
        'I need to buy some ice cream!',
        'I wanna buy a new car',
        'There\'s a problem with my phone',
        'I need to go to the doctor',
        'What are you up to today?',
        'Did you watch the game yesterday?',
        'How was your day?'
    ];

    private const LANGUAGES = [
        'en',
        'fr'
    ];

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadTime($manager);
    }

    private function loadTime(ObjectManager $manager)
    {
        for ($i = 0; $i < 30; $i++) {
            $time = new Time();
            $time>setText(
                self::POST_TEXT[rand(0, count(self::POST_TEXT) - 1)]
            );
            $date = new \DateTime();
            $date->modify('-' . rand(0, 10) . ' day');
            $time->setTime($date);
            $time->setUser($this->getReference(
                self::USERS[rand(0, count(self::USERS) - 1)]['username']
            ));
            $manager->persist(time);
        }

        $manager->flush();
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach (self::USERS as $userData) {
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setFullName($userData['fullName']);
            $user->setEmail($userData['email']);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $userData['password']
                )
            );
            $user->setRoles($userData['roles']);


            $this->addReference(
                $userData['username'],
                $user
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}