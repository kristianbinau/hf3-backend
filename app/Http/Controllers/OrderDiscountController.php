<?php

namespace App\Http\Controllers;

use App\Models\OrderDiscount;
use Illuminate\Http\Request;

class OrderDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders/{orderId}/discounts",
     *      operationId="OrderDiscountController.index",
     *      tags={"Orders"},
     *      summary="Get list of order discounts in order",
     *      description="Returns list of order discounts in order",
     *      @OA\Parameter(
     *          name="orderId",
     *          description="Order Id",
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
    public function index()
    {
        return Response(OrderDiscount::select('*')->paginate(500));
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDiscount  $orderDiscount
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders-discounts/{orderDiscountId}",
     *      operationId="OrderDiscountController.show",
     *      tags={"Orders"},
     *      summary="Get order discount",
     *      description="Returns Get order discount",
     *      @OA\Parameter(
     *          name="orderDiscountId",
     *          description="Order Discount Id",
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
    public function show(OrderDiscount $orderDiscount)
    {
        return Response($orderDiscount);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDiscount  $orderDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDiscount $orderDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDiscount  $orderDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDiscount $orderDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDiscount  $orderDiscount
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete (
     *      path="/api/orders-discounts/{orderDiscountId}",
     *      operationId="OrderDiscountController.show",
     *      tags={"Orders"},
     *      summary="Delete order discount",
     *      description="Deletes order discount and returns nothing",
     *      @OA\Parameter(
     *          name="orderDiscountId",
     *          description="Order Discount Id",
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
    public function destroy(OrderDiscount $orderDiscount)
    {
        $orderDiscount->delete();

        return Response('', 204);
    }
}
