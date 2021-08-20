<?php

namespace App\Http\Controllers;

use App\Models\OrderDelivery;
use Illuminate\Http\Request;

class OrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/orders/{orderId}/deliveries",
     *      operationId="OrderDeliveryController.index",
     *      tags={"Orders"},
     *      summary="Get list of order deliveries",
     *      description="Returns list of order deliveries",
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
    public function index()
    {
        return Response(OrderDelivery::select('*')->paginate(500));
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
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDelivery $orderDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDelivery $orderDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDelivery $orderDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDelivery  $orderDelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDelivery $orderDelivery)
    {
        //
    }
}
