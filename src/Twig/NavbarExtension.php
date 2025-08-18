<?php

namespace App\Twig;

use Twig\TwigFunction;
use Symfony\Component\Form\AbstractExtension;

class NavbarExtension extends AbstractExtension
{
    public function getFunctions():array
    {
        return [new TwigFunction('nav_actived', [$this, 'getNavbarActive']),];  
    }
    public function getNavbarActive(string $title): ?string
    {
        $navItems = [
            'Main', 'About',
            'Category', 'Product_Details',
            'Cart', 'Checkout', 'Contact'
        ]; 
        foreach ($navItems as $item) {
            if (strtolower($item) === strtolower($title)) {
                return 'active';
            }    
        }
        return '';  
    }
}