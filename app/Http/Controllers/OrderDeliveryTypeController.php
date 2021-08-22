<?php

namespace App\Http\Controllers;

use App\Models\OrderDeliveryType;
use Illuminate\Http\Request;

class OrderDeliveryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders-deliveries-types",
     *      operationId="OrderDeliveryTypeController.index",
     *      tags={"Orders"},
     *      summary="Get list of order delivery types",
     *      description="Returns list of  order delivery types",
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
        return Response(OrderDeliveryType::select('*')->paginate(500));
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
     * @param  \App\Models\OrderDeliveryType  $orderDeliveryType
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders-deliveries-types/{ordersDeliveriesTypeId}",
     *      operationId="OrderDeliveryTypeController.show",
     *      tags={"Orders"},
     *      summary="Get order delivery type",
     *      description="Returns Get order delivery type",
     *      @OA\Parameter(
     *          name="ordersDeliveriesTypeId",
     *          description="Orders Deliveries Type Id",
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
    public function show(OrderDeliveryType $orderDeliveryType)
    {
        return Response($orderDeliveryType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDeliveryType  $orderDeliveryType
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDeliveryType $orderDeliveryType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDeliveryType  $orderDeliveryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDeliveryType $orderDeliveryType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDeliveryType  $orderDeliveryType
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete (
     *      path="/api/orders-deliveries-types/{ordersDeliveriesTypeId}",
     *      operationId="OrderDeliveryTypeController.show",
     *      tags={"Orders"},
     *      summary="Delete order delivery type",
     *      description="Deletes order delivery type and returns nothing",
     *      @OA\Parameter(
     *          name="ordersDeliveriesTypeId",
     *          description="Orders Deliveries Type Id",
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
    public function destroy(OrderDeliveryType $orderDeliveryType)
    {
        $orderDeliveryType->delete();

        return Response('', 204);
    }
}
