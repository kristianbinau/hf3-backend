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
     *      path="/api/order-delivery-types",
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
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDeliveryType  $orderDeliveryType
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/order-delivery-types/{ordersDeliveriesTypeId}",
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
}
