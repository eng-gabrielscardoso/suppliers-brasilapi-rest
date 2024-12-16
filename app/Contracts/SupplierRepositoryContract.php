<?php

namespace App\Contracts;

interface SupplierRepositoryContract
{
    public function all();

    public function create(array $data);

    public function update(array $data, int $supplier);

    public function delete(int $supplier);

    public function find(int $supplier);
}
