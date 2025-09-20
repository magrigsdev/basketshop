<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixturesCategories extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories_data = [
            'Streetwear' => 'Sneakers tendance pour la rue et le lifestyle.',
            'Sport' => 'Chaussures conçues pour le sport et la performance.',
            'Casual' => 'Style décontracté et confortable.',
            'Skate' => 'Chaussures pour skateurs, résistantes et stylées.',
            'Luxe' => 'Baskets haut de gamme et exclusives.',
        ];

        $categories = [];
        foreach ($categories_data as $name => $desc) 
            {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($desc);
            $manager->persist($category);
            $categories[$name] = $category;
            // code...
        }
        $manager->flush();
    }
}
