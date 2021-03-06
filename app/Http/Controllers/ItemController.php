<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Items",
 *     description="",
 * )
 */
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/items",
     *      operationId="ItemController.index",
     *      tags={"Items"},
     *      summary="Get list of items",
     *      description="Returns list of items",
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
        return Response(Item::select('*')->paginate(500));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/items/{itemId}",
     *      operationId="ItemController.store",
     *      tags={"Items"},
     *      summary="Store item",
     *      description="Stores item and returns Get item",
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item Id",
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
            'location_id' => 'bail|required|integer|exists:locations,id',
            'product_id' => 'bail|required|integer|exists:products,id',
            'discount_price' => 'bail|required|nullable|integer',
            'status ' => 'bail|required',
        ]);

        $item = Item::create($request->all());

        return $this->show($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/items/{itemId}",
     *      operationId="ItemController.show",
     *      tags={"Items"},
     *      summary="Get item",
     *      description="Returns Get item",
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item Id",
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
    public function show(Item $item)
    {
        return Response($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/items/{itemId}",
     *      operationId="ItemController.update",
     *      tags={"Items"},
     *      summary="Update item",
     *      description="Updates item and returns Get item",
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item Id",
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
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'location_id' => 'bail|integer|exists:locations,id',
            'product_id' => 'bail|integer|exists:products,id',
            'discount_price' => 'bail|integer',
            'status ' => 'bail',
        ]);

        $item->update($request->all());

        return $this->show($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/items/{itemId}",
     *      operationId="ItemController.destroy",
     *      tags={"Items"},
     *      summary="Delete item",
     *      description="Deletes item and returns nothing",
     *      @OA\Parameter(
     *          name="itemId",
     *          description="Item Id",
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
    public function destroy(Item $item)
    {
        $item->delete();

        return Response('', 204);
    }
}
