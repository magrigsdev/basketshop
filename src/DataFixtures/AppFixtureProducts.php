<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtureProducts extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $products = 
        [
            ['Nike Air Force 1', 'Classique indémodable', 110, 'https://www.nike.com/w/air-force-1-shoes-5sj3yzy7ok', 25, 'Streetwear'],
            ['Adidas Ultraboost', 'Confort ultime pour la course', 150, 'https://www.adidas.com/ultraboost', 30, 'Sport'],
            ['Puma Suede Classic', 'Style rétro intemporel', 85, 'https://www.puma.com/suede-classic', 20, 'Casual'],
            ['Vans Old Skool', 'Skate et lifestyle', 70, 'https://www.vans.com/old-skool', 40, 'Skate'],
            ['Luke 1977 Varsity', 'Streetwear britannique', 120, 'https://www.luke1977.com/varsity', 15, 'Luke'],
            ['Converse Chuck Taylor', 'Icône intemporelle', 65, 'https://www.converse.com/chuck-taylor', 35, 'Casual'],
            ['Nike Dunk Low', 'Style vintage et moderne', 100, 'https://www.nike.com/dunk-low', 28, 'Streetwear'],
            ['Adidas Forum Low', 'Classique basket revisité', 95, 'https://www.adidas.com/forum-low', 22, 'Sport'],
            ['Vans Sk8-Hi', 'Haute performance skate', 75, 'https://www.vans.com/sk8-hi', 18, 'Skate'],
            ['Luke 1977 Hoodie', 'Streetwear casual confortable', 90, 'https://www.luke1977.com/hoodie', 12, 'Luke'],
            ['New Balance 574', 'Confort et style rétro', 80, 'https://www.newbalance.com/574', 25, 'Casual'],
            ['Nike Air Max 90', 'Design iconique et confort', 120, 'https://www.nike.com/air-max-90', 30, 'Streetwear'],
            ['Adidas Predator', 'Performance sur le terrain', 140, 'https://www.adidas.com/predator', 20, 'Sport'],
            ['Puma Cali', 'Style décontracté et féminin', 85, 'https://www.puma.com/cali', 18, 'Casual'],
            ['Vans Authentic', 'Skate classique et lifestyle', 60, 'https://www.vans.com/authentic', 35, 'Skate'],
            ['Luke 1977 Jeans', 'Streetwear premium', 130, 'https://www.luke1977.com/jeans', 10, 'Luke'],
            ['Reebok Club C', 'Casual et confortable', 75, 'https://www.reebok.com/club-c', 28, 'Casual'],
            ['Nike Blazer Mid', 'Basket vintage et tendance', 105, 'https://www.nike.com/blazer-mid', 22, 'Streetwear'],
            ['Adidas Gazelle', 'Sport et lifestyle', 90, 'https://www.adidas.com/gazelle', 25, 'Sport'],
            ['Vans Slip-On', 'Facile à porter, skate et casual', 65, 'https://www.vans.com/slip-on', 30, 'Skate'],
            ['Nike Air Jordan 1', 'Basket légendaire pour les passionnés', 160, 'https://www.nike.com/air-jordan-1', 20, 'Streetwear'],
            ['Adidas NMD_R1', 'Confort et style urbain', 130, 'https://www.adidas.com/nmd_r1', 25, 'Sport'],
            ['Puma RS-X', 'Design audacieux et moderne', 110, 'https://www.puma.com/rs-x', 18, 'Casual'],
            ['Vans Era', 'Skateboard classique et lifestyle', 65, 'https://www.vans.com/era', 40, 'Skate'],
            ['Luke 1977 T-shirt', 'Streetwear premium et décontracté', 45, 'https://www.luke1977.com/tshirt', 22, 'Luke'],
            ['Converse One Star', 'Style casual iconique', 70, 'https://www.converse.com/one-star', 30, 'Casual'],
            ['Nike React Infinity', 'Performance et confort pour la course', 150, 'https://www.nike.com/react-infinity', 15, 'Sport'],
            ['Adidas Superstar', 'Icône streetwear depuis les années 70', 95, 'https://www.adidas.com/superstar', 28, 'Streetwear'],
            ['Vans Half Cab', 'Skate classique revisité', 75, 'https://www.vans.com/half-cab', 18, 'Skate'],
            ['Luke 1977 Sweatshirt', 'Streetwear chic et confortable', 85, 'https://www.luke1977.com/sweatshirt', 12, 'Luke'],
            ['New Balance 997H', 'Style rétro et confort moderne', 90, 'https://www.newbalance.com/997h', 20, 'Casual'],
            ['Nike Air Max 270', 'Confort maximal au quotidien', 150, 'https://www.nike.com/air-max-270', 25, 'Streetwear'],
            ['Adidas Adizero', 'Performance running haut de gamme', 140, 'https://www.adidas.com/adizero', 18, 'Sport'],
            ['Puma Suede Heart', 'Style féminin et décontracté', 80, 'https://www.puma.com/suede-heart', 15, 'Casual'],
            ['Vans Sk8-Low', 'Skateboard et streetwear', 70, 'https://www.vans.com/sk8-low', 35, 'Skate'],
            ['Luke 1977 Jacket', 'Veste streetwear premium', 150, 'https://www.luke1977.com/jacket', 10, 'Luke'],
            ['Reebok Classic Leather', 'Casual et confortable', 85, 'https://www.reebok.com/classic-leather', 28, 'Casual'],
            ['Nike Zoom Fly', 'Chaussure running rapide et légère', 160, 'https://www.nike.com/zoom-fly', 20, 'Sport'],
            ['Adidas ZX 2K', 'Design futuriste et performance', 120, 'https://www.adidas.com/zx-2k', 22, 'Streetwear'],
            ['Vans Checkerboard', 'Classique skate et lifestyle', 60, 'https://www.vans.com/checkerboard', 30, 'Skate'],
        ];


    }
}
