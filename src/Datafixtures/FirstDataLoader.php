<?php declare(strict_types=1);

namespace App\Datafixtures;

use App\Entities\Admin;
use App\Entities\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class FirstDataLoader implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $admin = new Admin();
        $admin->setUsername('admin');
        $admin->setEmail('admin@email.com');
        $admin->setPassword(password_hash('963852741', PASSWORD_DEFAULT));
        $admin->setCreated(new \DateTime('now'));
        $admin->setUpdated(new \DateTime('now'));
        $manager->persist($admin);


        $faker = \Faker\Factory::create();
        for($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setName($faker->firstName());
            $user->setEmail($faker->email());
            $user->setDesignation('asdfasdfasd');
            $user->setPassword(password_hash('secret', PASSWORD_DEFAULT));
            $user->setGender(rand(1, 10) > 5 ? 'male' : 'female');
            $user->setMobile($faker->phoneNumber());
            $user->setStatus('1');
            $user->setImage('https://avatar.iran.liara.run/public/27');
            $user->setCreated(new \DateTime('now'));
            $user->setUpdated(new \DateTime('now'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}