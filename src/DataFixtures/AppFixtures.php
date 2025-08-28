<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
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
        foreach ($categories_data as $name => $desc) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($desc);
            $manager->persist($category);
            $categories[$name] = $category;
            // code...
        }

        // Produits avec images
        $productsData = [
            ['Nike Air Force 1',
                'Classique indémodable',
                110,
                'https://www.nike.com/w/air-force-1-shoes-5sj3yzy7ok?utm_source=chatgpt.com',
                25,
                'Streetwear',
            ],

            ['Adidas Superstar',
                'Sneaker intemporelle',
                95,
                'https://www.adidas.com/us/superstar?utm_source=chatgpt.com',
                18,
                'Streetwear',
            ],

            ['Puma Suede Classic',
                'Un modèle rétro',
                85,
                'https://eu.puma.com/fr/fr/pd/sneakers-h-street%C2%A0og-unisexe/403692.html?dwvar_403692_color=01',
                'Streetwear',
            ],

            ['Reebok Classic Leather',
                'Style old-school',
                90,
                'https://www.reebok.eu/cdn/shop/files/23357172_54903064_800.webp?v=1744662949&width=800',
                20,
                'Sport'],

            ['New Balance 574',
                'Confort quotidien',
                100,
                'https://www.reebok.eu/cdn/shop/files/23357172_54903064_800.webp?v=1744662949&width=800',
                30,
                'Casual'],

            [
                'Jordan 1 Retro',
                'Modèle iconique',
                160,
                'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/69663b43-0df1-4443-a39d-be7de42a2663/NIKE+VAPOR+EDGE+360+UT.png',
                10,
                'Sport'],

            ['Converse Chuck Taylor', 'Look vintage', 75, 'https://www.converse.com/dw/image/v2/BJJF_PRD/on/demandware.static/-/Sites-cnv-master-catalog-we/default/dwd6b29769/images/c_08/A13294C_C_08X1.jpg?sw=406', 40, 'Streetwear'],
            ['Vans Old Skool', 'Sneaker de skate', 80, 'https://assets.vans.eu/images/t_img/c_fill,g_center,f_auto,h_815,w_652,e_unsharp_mask:100/dpr_2.0/v1755509546/VN0009QC6BT-HERO/Knu-Skool-Shoes.png', 22, 'Skate'],
            ['Asics Gel-Lyte III', 'Sneaker technique', 120, 'https://www.converse.com/dw/image/v2/BJJF_PRD/on/demandware.static/-/Sites-cnv-master-catalog-we/default/dwd6b29769/images/c_08/A13294C_C_08X1.jpg?sw=406', 15, 'Sport'],
            ['Balenciaga Triple S', 'Sneaker de luxe', 850, 'https://balenciaga.dam.kering.com/m/154df30b94fce56b/Large-534217W2CA11000_F.jpg?v=8', 5, 'Luxe'],
        ];

        foreach ($productsData as [$name, $desc, $price, $image, $stock, $cat]) {
            $product = new Product();
            $product->setName($name)
                ->setDescription($desc)
                ->setPrice($price)
                ->setImage($image)
                ->setStock($stock)
                ->setCategory($categories[$cat]);

            $manager->persist($product);
        }
        $manager->flush();
    }
}
