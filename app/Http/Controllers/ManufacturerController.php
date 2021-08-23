<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\AbstractList;

/**
 * @OA\Tag(
 *     name="Manufacturers",
 *     description="",
 * )
 */
class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/manufacturers",
     *      operationId="ManufacturerController.index",
     *      tags={"Manufacturers"},
     *      summary="Get list of manufacturers",
     *      description="Returns list of manufacturers",
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
        return Response(Manufacturer::select('*')->paginate(500));
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
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *      path="/api/manufacturers/{manufacturerId}",
     *      operationId="ManufacturerController.store",
     *      tags={"Manufacturers"},
     *      summary="Store manufacturer",
     *      description="Stores manufacturer and returns Get manufacturer",
     *      @OA\Parameter(
     *          name="manufacturerId",
     *          description="Manufacturer Id",
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
     *       },
     *     )
     */
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'bail|required|integer|exists:addresses,id',
            'name' => 'bail|required|max:255',
        ]);

        $manufacturer = Manufacturer::create($request->all());

        return $this->show($manufacturer);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/manufacturers/{manufacturerId}",
     *      operationId="ManufacturerController.show",
     *      tags={"Manufacturers"},
     *      summary="Get manufacturer",
     *      description="Returns Get manufacturer",
     *      @OA\Parameter(
     *          name="manufacturerId",
     *          description="Manufacturer Id",
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
    public function show(Manufacturer $manufacturer)
    {
        return Response($manufacturer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/manufacturers/{manufacturerId}",
     *      operationId="ManufacturerController.update",
     *      tags={"Manufacturers"},
     *      summary="Update manufacturer",
     *      description="Updates manufacturer and returns Get manufacturer",
     *      @OA\Parameter(
     *          name="manufacturerId",
     *          description="Manufacturer Id",
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
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $request->validate([
            'address_id' => 'bail|integer|exists:addresses,id',
            'name' => 'bail|max:255',
        ]);

        $manufacturer->update($request->all());

        return $this->show($manufacturer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Manufacturer $manufacturer
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *      path="/api/manufacturers/{manufacturerId}",
     *      operationId="ManufacturerController.destroy",
     *      tags={"Manufacturers"},
     *      summary="Delete manufacturer",
     *      description="Deletes manufacturer and returns nothing",
     *      @OA\Parameter(
     *          name="manufacturerId",
     *          description="Manufacturer Id",
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
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return Response('', 204);
    }
}
