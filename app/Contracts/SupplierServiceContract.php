<?php

namespace App\Contracts;

use App\Models\Supplier;

interface SupplierServiceContract
{
    public function all();

    public function create(array $data);

    public function update(array $data, Supplier $supplier);

    public function delete(Supplier $supplier);

    public function find(Supplier $supplier);
}
