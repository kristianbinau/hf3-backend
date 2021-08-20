<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/customer/{customerId}/orders",
     *      operationId="CustomerOrderController.index",
     *      tags={"Customers"},
     *      summary="Get list of orders in customer",
     *      description="Returns list of orders in customer",
     *      @OA\Parameter(
     *          name="customerId",
     *          description="Customer Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
    public function index(Customer $customer)
    {
        return Response($customer->orders()->paginate(500));
    }
}
