<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Specification;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasherInterface)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setBrand($faker->randomElement(["Apple", "Samsung", "Huawei", "Xiaomi", "OnePlus", "Google", "Sony", "Nokia", "Motorola", "Oppo"]));
            $product->setColor($faker->colorName());
            $product->setDescription($faker->sentence(50));
            $product->setImage($faker->imageUrl(500, 500));
            $product->setModel($faker->randomElement(["iPhone 13", "Galaxy S21", "P40 Pro", "Mi 11", "OnePlus 9", "Pixel 5", "Xperia 5", "8.3 5G", "Moto G", "Reno 5"]));
            $product->setPrice($faker->randomFloat(2, 100, 1000));
            $product->setStock($faker->randomElement([true, false]));
            $product->setType("Smartphone");

            $specification = new Specification();
            $specification->setBattery($faker->randomElement(["3000mAh", "4000mAh", "4500mAh", "5000mAh", "6000mAh"]));
            $specification->setOs($faker->randomElement(["iOS", "Android", "HarmonyOS"]));
            $specification->setProcessor($faker->randomElement(["A14 Bionic", "Snapdragon 888", "Kirin 9000", "Exynos 2100", "Dimensity 1200"]));
            $specification->setRam($faker->randomElement(["4GB", "6GB", "8GB", "12GB", "16GB"]));
            $specification->setResolution($faker->randomElement(["1080x2400", "1170x2532", "1440x3200", "720x1600", "1284x2778"]));
            $specification->setStorage($faker->randomElement(["64GB", "128GB", "256GB", "512GB", "1TB"]));
            $specification->setWeight($faker->randomElement([150, 175, 200, 225, 250]));

            $product->setSpecs($specification);

            $manager->persist($specification);
            $manager->persist($product);
        }

        $clients = [];

        for ($i = 0; $i < 3; $i++) {
            $client = new Client();
            $client->setCompany($faker->unique()->company);
            $client->setEmail($faker->email);
            $client->setPassword($this->passwordHasherInterface->hashPassword($client, "password"));

            $clients[] = $client;

            $manager->persist($client);
        }

        for ($i = 0; $i < 21; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setPhoneNumber($faker->phoneNumber);
            $addCompany = $faker->randomElement($clients);
            $user->addClient($addCompany);

            $address = new Address();
            $address->setCity($faker->city);
            $address->setCountry($faker->country);
            $address->setStreet($faker->streetAddress);
            $address->setZipCode($faker->postcode);
            $address->setUser($user);

            $user->addAddress($address);

            $manager->persist($address);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
