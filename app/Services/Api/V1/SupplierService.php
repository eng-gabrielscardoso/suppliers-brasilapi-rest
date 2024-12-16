<?php

namespace App\Services\Api\V1;

use App\Contracts\SupplierServiceContract;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;

class SupplierService implements SupplierServiceContract
{
    public function __construct(
        private readonly SupplierRepository $supplierRepository
    ) {}

    public function all()
    {
        return $this->supplierRepository->all();
    }

    public function create(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function update(array $data, Supplier $supplier)
    {
        return $this->supplierRepository->update($data, $supplier->id);
    }

    public function delete(Supplier $supplier)
    {
        return $this->supplierRepository->delete($supplier->id);
    }

    public function find(Supplier $supplier)
    {
        return $this->supplierRepository->find($supplier->id);
    }
}
