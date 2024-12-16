<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Api\V1\Suppliers\UpdateSupplierRequest;
use App\Http\Resources\Api\V1\Suppliers\SupplierResource;
use App\Models\Supplier;
use App\Services\Api\V1\SupplierService;

class SupplierController extends Controller
{
    public function __construct(
        private readonly SupplierService $supplierService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SupplierResource::collection(
            $this->supplierService->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        $data = $request->validated();

        $resource = $this->supplierService->create($data);

        return new SupplierResource($resource);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $resource = $this->supplierService->find($supplier);

        return new SupplierResource($resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();

        $resource = $this->supplierService->update($data, $supplier);

        return new SupplierResource($resource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $this->supplierService->delete($supplier);

        return response()->noContent();
    }
}
