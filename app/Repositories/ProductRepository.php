<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\InventoryLog;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all($limit, $offset)
    {
        return $this->model->with(['category', 'supplier'])->paginate($limit);
    }
   public function getQuery()
    {
        return $this->model->newQuery();
    }


    public function find($id)
    {
        return $this->model->with(['category', 'supplier'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function findBySku($sku)
    {
        return $this->model->where('sku', $sku)->first();
    }

    public function findByCategory($categoryId)
    {
        return $this->model->with(['category', 'supplier'])
            ->where('category_id', $categoryId)
            ->get();
    }

    public function findByPriceRange($minPrice, $maxPrice)
    {
        return $this->model->with(['category', 'supplier'])
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->get();
    }

    public function findInStock()
    {
        return $this->model->with(['category', 'supplier'])->inStock()->get();
    }

    public function findOutOfStock()
    {
        return $this->model->with(['category', 'supplier'])->outOfStock()->get();
    }

    public function findLowStock($threshold = 10)
    {
        return $this->model->with(['category', 'supplier'])->lowStock($threshold)->get();
    }

    public function updateQuantity($id, $quantity, $type, $userId, $notes = null)
    {
        return DB::transaction(function () use ($id, $quantity, $type, $userId, $notes) {
            $product = $this->find($id);
            $previousQuantity = $product->quantity;

            if ($type === 'add') {
                $newQuantity = $previousQuantity + $quantity;
            } else {
                $newQuantity = $previousQuantity - $quantity;
                if ($newQuantity < 0) {
                    throw ValidationException::withMessages([
                        'quantity' => ['Insufficient stock. Available: ' . $previousQuantity],
                    ]);

                }
            }

            $product->update(['quantity' => $newQuantity]);

            InventoryLog::create([
                'product_id' => $id,
                'user_id' => $userId,
                'type' => $type,
                'quantity' => abs($quantity),
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $newQuantity,
                'notes' => $notes,
            ]);

            return $product->fresh();
        });
    }
}