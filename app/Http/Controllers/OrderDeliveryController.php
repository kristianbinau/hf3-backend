<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Http\Request;

class OrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/order/{orderId}/deliveries",
     *      operationId="OrderDeliveryController.index",
     *      tags={"Orders"},
     *      summary="Get list of order deliveries in order",
     *      description="Returns list of order deliveries in order",
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
    public function index(Order $order)
    {
        return Response($order->delivery()->paginate(500));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/order/{orderId}/deliveries",
     *      operationId="OrderDeliveryController.store",
     *      tags={"Orders"},
     *      summary="Store order delivery in order",
     *      description="Stores order delivery in order and returns Get order delivery",
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
    public function store(Request $request, Order $order)
    {
        $request->order_id = $order->id;

        $request->validate([
            'order_id' => 'bail|required|integer|exists:orders,id|unique:order_deliveries,order_id',
            'address_id' => 'bail|required|integer|exists:addresses,id',
            'order_delivery_type_id' => 'bail|required|integer|exists:order_delivery_types,id',
            'carrier' => 'bail|required|nullable|max:255',
            'tracking_id' => 'bail|required|nullable|max:255',
            'status' => 'bail|required',
        ]);

        $orderDelivery = OrderDelivery::create($request->all());

        return $this->show($orderDelivery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/order-deliveries/{orderDeliveryId}",
     *      operationId="OrderDeliveryController.show",
     *      tags={"Orders"},
     *      summary="Get order delivery",
     *      description="Returns Get order delivery",
     *      @OA\Parameter(
     *          name="orderDeliveryId",
     *          description="Order Delivery Id",
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
    public function show(OrderDelivery $orderDelivery)
    {
        return Response($orderDelivery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/order-deliveries/{orderDeliveryId}",
     *      operationId="OrderDeliveryController.update",
     *      tags={"Orders"},
     *      summary="Get order delivery",
     *      summary="Update order delivery",
     *      description="Updates order delivery and returns Get order delivery",
     *      @OA\Parameter(
     *          name="orderDeliveryId",
     *          description="Order Delivery Id",
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
    public function update(Request $request, OrderDelivery $orderDelivery)
    {
        $request->validate([
            'order_id' => 'bail|integer|exists:orders,id|unique:order_deliveries,order_id',
            'address_id' => 'bail|integer|exists:addresses,id',
            'order_delivery_type_id' => 'bail|integer|exists:order_delivery_types,id',
            'carrier' => 'bail|nullable|max:255',
            'tracking_id' => 'bail|nullable|max:255',
            'status' => 'bail',
        ]);

        $orderDelivery->update($request->all());

        return $this->show($orderDelivery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete (
     *      path="/api/order-deliveries/{orderDeliveryId}",
     *      operationId="OrderDeliveryController.destroy",
     *      tags={"Orders"},
     *      summary="Delete order delivery",
     *      description="Deletes order delivery and returns nothing",
     *      @OA\Parameter(
     *          name="orderDeliveryId",
     *          description="Order Delivery Id",
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
    public function destroy(OrderDelivery $orderDelivery)
    {
        $orderDelivery->delete();

        return Response('', 204);
    }
}
