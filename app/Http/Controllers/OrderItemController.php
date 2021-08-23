<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders/{orderId}/items",
     *      operationId="OrderItemController.index",
     *      tags={"Orders"},
     *      summary="Get list of order items in order",
     *      description="Returns list of order items in order",
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
    public function index(Order $order)
    {
        return Response($order->items()->paginate(500));
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
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/orders/{orderId}/items",
     *      operationId="OrderItemController.store",
     *      tags={"Orders"},
     *      summary="Store order item in order",
     *      description="Stores order item in order and returns Get order item",
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
            'order_id' => 'bail|required|integer|exists:orders,id',
            'item_id' => 'bail|required|integer|exists:items,id',
            'price' => 'bail|required|integer',
            'status' => 'bail|required',
        ]);

        $orderItem = OrderItem::create($request->all());

        return $this->show($orderItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders-items/{orderItemId}",
     *      operationId="OrderItemController.show",
     *      tags={"Orders"},
     *      summary="Get order item",
     *      description="Returns Get order item",
     *      @OA\Parameter(
     *          name="orderItemId",
     *          description="Order Item Id",
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
    public function show(OrderItem $orderItem)
    {
        return Response($orderItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch (
     *      path="/api/orders/{orderId}/items",
     *      operationId="OrderItemController.update",
     *      tags={"Orders"},
     *      summary="Update order item",
     *      description="Updates order item and returns Get order item",
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
    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'order_id' => 'bail|integer|exists:orders,id',
            'item_id' => 'bail|integer|exists:items,id',
            'price' => 'bail|integer',
            'status' => 'bail',
        ]);

        $orderItem->update($request->all());

        return $this->show($orderItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/orders-items/{orderItemId}",
     *      operationId="OrderItemController.show",
     *      tags={"Orders"},
     *      summary="Delete order item",
     *      description="Deletes order item and returns nothing",
     *      @OA\Parameter(
     *          name="orderItemId",
     *          description="Order Item Id",
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
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return Response('', 204);
    }
}
