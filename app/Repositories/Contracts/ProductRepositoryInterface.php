<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends CommanRepositoryInterface
{
    public function getQuery();
    public function findBySku($sku);
    public function findByCategory($categoryId);
    public function findByPriceRange($minPrice, $maxPrice);
    public function findInStock();
    public function findOutOfStock();
    public function findLowStock($threshold = 10);
    public function updateQuantity($id, $quantity, $type, $userId, $notes = null);
}