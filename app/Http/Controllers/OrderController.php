<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Orders",
 *     description="",
 * )
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders",
     *      operationId="OrderController.index",
     *      tags={"Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
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
        return Response(Order::select('*')->paginate(500));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/orders/{orderId}",
     *      operationId="OrderController.store",
     *      tags={"Orders"},
     *      summary="Get order",
     *      summary="Store order",
     *      description="Stores order and returns Get order",
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
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'bail|required|integer|exists:customers,id',
            'extra_info' => 'bail|required|nullable|max:255',
            'status ' => 'bail|required',
        ]);

        $order = Order::create($request->all());

        return $this->show($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders/{orderId}",
     *      operationId="OrderController.show",
     *      tags={"Orders"},
     *      summary="Get order",
     *      description="Returns Get order",
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
    public function show(Order $order)
    {
        return Response($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/orders/{orderId}",
     *      operationId="OrderController.update",
     *      tags={"Orders"},
     *      summary="Get order",
     *      summary="Update order",
     *      description="Updates order and returns Get order",
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
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'bail|integer|exists:customers,id',
            'extra_info' => 'bail|nullable|max:255',
            'status ' => 'bail',
        ]);

        $order->update($request->all());

        return $this->show($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/orders/{orderId}",
     *      operationId="OrderController.show",
     *      tags={"Orders"},
     *      summary="Delete order",
     *      description="Deletes order and returns nothing",
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
    public function destroy(Order $order)
    {
        $order->delete();

        return Response('', 204);
    }
}
