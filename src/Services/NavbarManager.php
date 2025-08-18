<?php 

namespace App\Services;

class NavbarManager
{
    private array $nav_items = [
        'Main', 'About',
        'Category', 'Product_Details',
        'Cart', 'Checkout', 'Contact'
    ];
    public function getNavItems():array
    {
        return $this->nav_items;
    }
    public function getNavActive(string $title): ?string
    {
        foreach ($this->nav_items as $item) {
            if (strtolower($item) === strtolower($title)) {
                return 'active';
            }   
        }
        return '';
    }
}  