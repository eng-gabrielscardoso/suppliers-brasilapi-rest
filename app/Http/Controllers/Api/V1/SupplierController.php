<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Api\V1\Suppliers\UpdateSupplierRequest;
use App\Http\Resources\Api\V1\Suppliers\SupplierResource;
use App\Models\Supplier;
use App\Services\Api\V1\SupplierService;

/**
 * @OA\PathItem(path="/api/v1/suppliers")
 */
class SupplierController extends Controller
{
    public function __construct(
        private readonly SupplierService $supplierService
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *  path="/api/v1/suppliers",
     *  summary="Display a listing of the suppliers",
     *  description="Fetch and list all suppliers with optional filtering and sorting",
     *  tags={"Suppliers"},
     *  @OA\Response(
     *      response=200,
     *      description="List of suppliers",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     * )
     */
    public function index()
    {
        return SupplierResource::collection(
            $this->supplierService->all()->filter()->sort()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *  path="/api/v1/suppliers",
     *  summary="Store a new supplier",
     *  description="Create a new supplier in the system",
     *  tags={"Suppliers"},
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              required={"active", "company_name", "trading_name", "registration_number", "registration_type"},
     *              @OA\Property(property="active", type="boolean", description="Indicates if the supplier is active"),
     *              @OA\Property(property="company_name", type="string", description="The legal name of the company"),
     *              @OA\Property(property="trading_name", type="string", description="The trading name of the supplier"),
     *              @OA\Property(property="registration_number", type="string", description="The supplier's registration number"),
     *              @OA\Property(property="registration_type", type="string", enum={"cnpj", "cpf"}, description="The type of registration"),
     *              @OA\Property(property="contact_email", type="string", description="The supplier's contact email"),
     *              @OA\Property(property="contact_isd_code", type="string", description="Country code for the contact phone"),
     *              @OA\Property(property="contact_phone_number", type="string", description="Phone number for contacting the supplier"),
     *              @OA\Property(property="address_country", type="string", description="Country of the supplier's address in ISO3166Alpha2 format (e.g. BR)"),
     *              @OA\Property(property="address_postal_code", type="string", description="Postal code of the supplier's address"),
     *              @OA\Property(property="address_province", type="string", description="Province of the supplier's address"),
     *              @OA\Property(property="address_street", type="string", description="Street address of the supplier")
     *          )
     *      )
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Supplier created successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Validation error",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     * )
     */
    public function store(StoreSupplierRequest $request)
    {
        $data = $request->validated();

        $resource = $this->supplierService->create($data);

        return new SupplierResource($resource);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *  path="/api/v1/suppliers/{supplier}",
     *  summary="Display the specified supplier",
     *  description="Fetch and display the details of a single supplier",
     *  tags={"Suppliers"},
     *  @OA\Parameter(
     *      name="supplier",
     *      in="path",
     *      required=true,
     *      description="The ID of the supplier to fetch",
     *      @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Supplier details",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     *  @OA\Response(
     *      response=404,
     *      description="Supplier not found",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     * )
     */
    public function show(Supplier $supplier)
    {
        $resource = $this->supplierService->find($supplier);

        return new SupplierResource($resource);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *  path="/api/v1/suppliers/{supplier}",
     *  summary="Update an existing supplier",
     *  description="Update the details of an existing supplier",
     *  tags={"Suppliers"},
     *  @OA\Parameter(
     *      name="supplier",
     *      in="path",
     *      required=true,
     *      description="The ID of the supplier to update",
     *      @OA\Schema(type="integer")
     *  ),
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              type="object",
     *              required={},
     *              @OA\Property(property="active", type="boolean", description="Indicates if the supplier is active"),
     *              @OA\Property(property="company_name", type="string", description="The legal name of the company"),
     *              @OA\Property(property="trading_name", type="string", description="The trading name of the supplier"),
     *              @OA\Property(property="registration_number", type="string", description="The supplier's registration number"),
     *              @OA\Property(property="registration_type", type="string", enum={"cnpj", "cpf"}, description="The type of registration"),
     *              @OA\Property(property="contact_email", type="string", description="The supplier's contact email"),
     *              @OA\Property(property="contact_isd_code", type="string", description="Country code for the contact phone"),
     *              @OA\Property(property="contact_phone_number", type="string", description="Phone number for contacting the supplier"),
     *              @OA\Property(property="address_country", type="string", description="Country of the supplier's address in ISO3166Alpha2 format (e.g. BR)"),
     *              @OA\Property(property="address_postal_code", type="string", description="Postal code of the supplier's address"),
     *              @OA\Property(property="address_province", type="string", description="Province of the supplier's address"),
     *              @OA\Property(property="address_street", type="string", description="Street address of the supplier")
     *          )
     *      )
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Supplier updated successfully",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Validation error",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *  ),
     * )
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();

        $resource = $this->supplierService->update($data, $supplier);

        return new SupplierResource($resource);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *  path="/api/v1/suppliers/{supplier}",
     *  summary="Delete a supplier",
     *  description="Remove a supplier from the system",
     *  tags={"Suppliers"},
     *  @OA\Parameter(
     *      name="supplier",
     *      in="path",
     *      required=true,
     *      description="The ID of the supplier to delete",
     *      @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(
     *      response=204,
     *      description="Supplier deleted successfully",
     *  ),
     *  @OA\Response(
     *      response=404,
     *      description="Supplier not found",
     *  ),
     * )
     */
    public function destroy(Supplier $supplier)
    {
        $this->supplierService->delete($supplier);

        return response()->noContent();
    }
}
