<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private CategoryRepository $category_repository;
    private ProductRepository $produit_repository;

    public function __construct(
        CategoryRepository $category_repository,
        ProductRepository $produit_repository,
    ) {
        $this->category_repository = $category_repository;
        $this->produit_repository = $produit_repository;
    }

    public function load(ObjectManager $objectManager): void
    {
        $categories_data = [
            'Streetwear' => 'Sneakers tendance pour la rue et le lifestyle.',
            'Sport' => 'Chaussures conçues pour le sport et la performance.',
            'Casual' => 'Style décontracté et confortable.',
            'Skate' => 'Chaussures pour skateurs, résistantes et stylées.',
            'Luxe' => 'Baskets haut de gamme et exclusives.',
        ];
        $is_categories = false;

        if (count($categories_data) === $this->category_repository->getCount()) {
            echo '😭 La table category regroupe actuellement ('. $this->category_repository->getCount(). ') catégories.' . "\n";
            $is_categories = true;
            // return; // rien à faire
        }
        

        if (false === $is_categories) {
            foreach ($categories_data as $name => $desc) {
                $category = new Category();
                $category->setName($name);
                $category->setDescription($desc);
                $objectManager->persist($category);
            }
            $objectManager->flush();
        }

        // produits
        // // Produits avec images
            // $productsData =
            //         [
            //             ['Nike Air Force 1',
            //                 'Classique indémodable',
            //                 110,
            //                 'https://www.nike.com/w/air-force-1-shoes-5sj3yzy7ok?utm_source=chatgpt.com',
            //                 25,
            //                 'Streetwear',
            //             ],

            //             ['Adidas Superstar',
            //                 'Sneaker intemporelle',
            //                 95,
            //                 'https://www.adidas.com/us/superstar?utm_source=chatgpt.com',
            //                 18,
            //                 'Streetwear',
            //             ],

            //             ['Reebok Classic Leather',
            //                 'Style old-school',
            //                 90,
            //                 'https://www.reebok.eu/cdn/shop/files/23357172_54903064_800.webp?v=1744662949&width=800',
            //                 20,
            //                 'Sport',
            //             ],

            //             ['New Balance 574',
            //                 'Confort quotidien',
            //                 100,
            //                 'https://www.reebok.eu/cdn/shop/files/23357172_54903064_800.webp?v=1744662949&width=800',
            //                 30,
            //                 'Casual',
            //             ],

            //             [
            //                 'Jordan 1 Retro',
            //                 'Modèle iconique',
            //                 160,
            //                 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/69663b43-0df1-4443-a39d-be7de42a2663/NIKE+VAPOR+EDGE+360+UT.png',
            //                 10,
            //                 'Sport',
            //             ],

            //             ['Converse Chuck Taylor',
            //                 'Look vintage',
            //                 75,
            //                 'https://www.converse.com/dw/image/v2/BJJF_PRD/on/demandware.static/-/Sites-cnv-master-catalog-we/default/dwd6b29769/images/c_08/A13294C_C_08X1.jpg?sw=406',
            //                 40,
            //                 'Streetwear',
            //             ],
            //             ['Vans Old Skool', 
            //             'Sneaker de skate', 80, 
            //             'https://assets.vans.eu/images/t_img/c_fill,g_center,f_auto,h_815,w_652,e_unsharp_mask:100/dpr_2.0/v1755509546/VN0009QC6BT-HERO/Knu-Skool-Shoes.png', 22, 'Skate',
            //             ],
            //             ['Asics Gel-Lyte III', 'Sneaker technique', 120, 'https://www.converse.com/dw/image/v2/BJJF_PRD/on/demandware.static/-/Sites-cnv-master-catalog-we/default/dwd6b29769/images/c_08/A13294C_C_08X1.jpg?sw=406', 15, 'Sport',
            //             ],
            //             ['Balenciaga Triple S', 'Sneaker de luxe', 850, 'https://balenciaga.dam.kering.com/m/154df30b94fce56b/Large-534217W2CA11000_F.jpg?v=8', 5, 'Luxe',
            //             ],
            //         ];

            $product1 = new Product();
            $product1->setName('Air Max Casual');
            $product1->setPrice(120);
            $product1->setCategory($this->category_repository->getIdByName('name','Streetwear')); // 👈 lié à Casual            
            $product1->setDescription('Classique indémodable');
            $product1->setImage('https://www.nike.com/w/air-force-1-shoes-5sj3yzy7ok?utm_source=chatgpt.com');
            $product1->setStock(200);
            $objectManager->persist($product1);
            $objectManager->flush();

            //#################################
            $product2 = new Product();
            $product2->setName('Nike Air Force 1');
            $product2->setPrice(110);
            $product2->setCategory($this->category_repository->getIdByName('name','Streetwear')); // 👈 lié à Casual            
            $product2->setDescription('Classique indémodable');
            $product2->setImage('https://www.nike.com/w/air-force-1-shoes-5sj3yzy7ok?utm_source=chatgpt.com');
            $product2->setStock(25);
            $objectManager->persist($product2);
            $objectManager->flush();

            

            //#################################
            $product4 = new Product();
            $product4->setName('New Balance 574');
            $product4->setPrice(100);
            $product4->setCategory($this->category_repository->getIdByName('name','Streetwear')); // 👈 lié à Casual            
            $product4->setDescription('Confort quotidien');
            $product4->setImage('https://www.reebok.eu/cdn/shop/files/23357172_54903064_800.webp?v=1744662949&width=800');
            $product4->setStock(30);
            $objectManager->persist($product4);
            $objectManager->flush();


        echo ' 👍 operation Terminé';
    }
}
