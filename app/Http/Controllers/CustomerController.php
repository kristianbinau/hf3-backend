<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Customers",
 *     description="",
 * )
 */
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/customers",
     *      operationId="CustomerController.index",
     *      tags={"Customers"},
     *      summary="Get list of customers",
     *      description="Returns list of customers",
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              default=1
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function index()
    {
        return Response(Customer::select('*')->paginate(500));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/customers/{customerId}",
     *      operationId="CustomerController.store",
     *      tags={"Customers"},
     *      summary="Get customer",
     *      summary="Store customer",
     *      description="Stores customer and returns Get customer",
     *      @OA\Parameter(
     *          name="customerId",
     *          description="Customer Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function store(Request $request)
    {
        $request->validate([
            'login_id' => 'bail|required|integer|exists:logins,id|unique:customers,login_id|unique:employees,login_id',
            'address_id' => 'bail|required|integer|exists:addresses,id',
            'name' => 'bail|required|max:255',
        ]);

        $customer = Customer::create($request->all());

        return $this->show($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/customers/{customerId}",
     *      operationId="CustomerController.show",
     *      tags={"Customers"},
     *      summary="Get customer",
     *      description="Returns Get customer",
     *      @OA\Parameter(
     *          name="customerId",
     *          description="Customer Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function show(Customer $customer)
    {
        return Response($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/customers/{customerId}",
     *      operationId="CustomerController.update",
     *      tags={"Customers"},
     *      summary="Update customer",
     *      description="Updates customer and returns Get customer",
     *      @OA\Parameter(
     *          name="customerId",
     *          description="Customer Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'login_id' => 'bail|integer|exists:logins,id|unique:customers,login_id|unique:employees,login_id',
            'address_id' => 'bail|integer|exists:addresses,id',
            'name' => 'bail|max:255',
        ]);

        $customer->update($request->all());

        return $this->show($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/customers/{customerId}",
     *      operationId="CustomerController.destroy",
     *      tags={"Customers"},
     *      summary="Delete customer",
     *      description="Deletes customer and returns nothing",
     *      @OA\Parameter(
     *          name="customerId",
     *          description="Customer Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          ),
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad request"
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *       ),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Response('', 204);
    }
}
