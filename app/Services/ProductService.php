<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // public function getAllProducts()
    // {
    //     return $this->productRepository->all();
    // }

    public function getProduct($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        // Generating dynamic sku
        if (!isset($data['sku'])) {
            $data['sku'] = $this->generateSku($data['name']);
        }

        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
    public function filterProducts(array $filters, $limit, $offset)
    {
        $query = $this->productRepository->getQuery(); // return a base query builder instance

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $query->whereBetween('price', [$filters['min_price'], $filters['max_price']]);
        }

       if (isset($filters['stock'])) {
            $stockQty = (int) $filters['stock'];

            $query->where('quantity', '>=', $stockQty);
        }

        return $query->with(['category', 'supplier'])->paginate($limit, ['*'], 'page', $offset);
    }


    public function updateInventory($id, $quantity, $type, $userId, $notes = null)
    {
        return $this->productRepository->updateQuantity($id, $quantity, $type, $userId, $notes);
    }

    private function generateSku($name)
    {
        $prefix = strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $name), 0, 3));
        $timestamp = time();
        return $prefix . $timestamp;
    }
}