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
     *      path="/api/ordersDeliveriesTypes",
     *      operationId="OrderDeliveryTypeController.index.all",
     *      tags={"Orders"},
     *      summary="Get list of order delivery types",
     *      description="Returns list of  order delivery types",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
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
     *
     *
     * @OA\Get(
     *      path="/api/orders/{orderId}/deliveries/{deliveryId}/types",
     *      operationId="OrderDeliveryTypeController.index",
     *      tags={"Orders"},
     *      summary="Get list of order delivery types by order and deliveryId",
     *      description="Returns list of  order delivery types order and deliveryId",
     *      @OA\Parameter(
     *          name="orderId",
     *          description="Order Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="deliveryId",
     *          description="Delivery Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
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
    public function index(int $orderId = NULL, int $deliveryId = NULL)
    {
        error_log(print_r($orderId, true));
        error_log(print_r($deliveryId, true));
        if ($orderId !== NULL && $deliveryId !== NULL) {
            error_log(print_r("NOT NULL", true));
            return Response(OrderDeliveryType::select('*')->paginate(500));
        }

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
     */
    public function show(OrderDeliveryType $orderDeliveryType)
    {
        //
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
     */
    public function destroy(OrderDeliveryType $orderDeliveryType)
    {
        //
    }
}
