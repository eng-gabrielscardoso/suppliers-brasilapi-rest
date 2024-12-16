<?php

namespace App\Repositories;

use App\Contracts\SupplierRepositoryContract;
use App\Exceptions\Api\V1\NotFoundException;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class SupplierRepository implements SupplierRepositoryContract
{
    public function all(): Collection
    {
        return Supplier::all();
    }

    public function create(array $data): Supplier
    {
        return Supplier::create($data);
    }

    public function update(array $data, int $supplier): Supplier
    {
        $supplier = $this->find($supplier);

        $supplier->update($data);

        return $supplier;
    }

    public function delete(int $supplier): void
    {
        $supplier = $this->find($supplier);
        $supplier->delete();
    }

    public function find(int $supplier): Supplier
    {
        $supplier = Supplier::findOrFail($supplier);

        if (!$supplier) {
            throw new NotFoundException();
        }

        return $supplier;
    }
}
