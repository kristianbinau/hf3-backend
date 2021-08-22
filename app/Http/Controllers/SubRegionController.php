<?php

namespace App\Http\Controllers;

use App\Models\SubRegion;
use Illuminate\Http\Request;

class SubRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/subregion",
     *      operationId="SubRegionController.index",
     *      tags={"Addresses"},
     *      summary="Get list of subregion",
     *      description="Returns list of subregion",
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
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
        return Response(SubRegion::select('*')->paginate(500));
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
     * @param  \App\Models\SubRegion  $subRegion
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/subregions/{subRegionId}",
     *      operationId="RegionController.show",
     *      tags={"Addresses"},
     *      summary="Get subregion",
     *      description="Returns Get subregion",
     *      @OA\Parameter(
     *          name="subRegionId",
     *          description="SubRegion Id",
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
    public function show(SubRegion $subRegion)
    {
        return Response($subRegion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubRegion  $subRegion
     * @return \Illuminate\Http\Response
     */
    public function edit(SubRegion $subRegion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubRegion  $subRegion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubRegion $subRegion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubRegion  $subRegion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubRegion $subRegion)
    {
        //
    }
}
