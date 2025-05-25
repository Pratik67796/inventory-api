<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function all($limit, $offset);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getQuery();
    public function updateQuantity($id, $quantity, $type, $userId, $notes = null);
}