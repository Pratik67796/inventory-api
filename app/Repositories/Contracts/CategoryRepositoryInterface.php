<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function all($limit,$offset);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}