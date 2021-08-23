<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

/**
* @OA\Tag(
 *     name="Addresses",
 *     description="",
 * )
 */
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/addresses",
     *      operationId="AddressController.index",
     *      tags={"Addresses"},
     *      summary="Get list of addresses",
     *      description="Returns list of addresses",
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
        return Response(Address::select('*')->paginate(500));
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
     *
     * @OA\Post(
     *      path="/api/addresses/{addressId}",
     *      operationId="AddressController.store",
     *      tags={"Addresses"},
     *      summary="Store address",
     *      description="Stores address and returns Get address",
     *      @OA\Parameter(
     *          name="addressId",
     *          description="Address Id",
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
            'city_id' => 'bail|required|integer|exists:cities,id',
            'road' => 'bail|required|max:255',
            'road_num' => 'bail|required|max:255',
            'apartment_floor' => 'bail|required|nullable|max:255',
            'apartment_num' => 'bail|required|nullable|max:255',
        ]);

        $address = Address::create($request->all());

        return $this->show($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/addresses/{addressId}",
     *      operationId="AddressController.show",
     *      tags={"Addresses"},
     *      summary="Get address",
     *      description="Returns Get address",
     *      @OA\Parameter(
     *          name="addressId",
     *          description="Address Id",
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
    public function show(Address $address)
    {
        return Response($address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *      path="/api/addresses/{addressId}",
     *      operationId="AddressController.update",
     *      tags={"Addresses"},
     *      summary="Update address",
     *      description="Updates address and returns Get address",
     *      @OA\Parameter(
     *          name="addressId",
     *          description="Address Id",
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
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'city_id' => 'bail|integer|exists:cities,id',
            'road' => 'bail|max:255',
            'road_num' => 'bail|max:255',
            'apartment_floor' => 'bail|nullable|max:255',
            'apartment_num' => 'bail|nullable|max:255',
        ]);

        $address->update($request->all());

        return $this->show($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
