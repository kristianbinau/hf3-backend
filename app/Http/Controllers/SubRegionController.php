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
     *      path="/api/sub-regions",
     *      operationId="SubRegionController.index",
     *      tags={"Addresses"},
     *      summary="Get list of sub region",
     *      description="Returns list of sub region",
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
        return Response(SubRegion::select('*')->paginate(500));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubRegion  $subRegion
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/sub-regions/{subRegionId}",
     *      operationId="SubRegionController.show",
     *      tags={"Addresses"},
     *      summary="Get sub region",
     *      description="Returns Get sub region",
     *      @OA\Parameter(
     *          name="subRegionId",
     *          description="Sub Region Id",
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
    public function show(SubRegion $subRegion)
    {
        return Response($subRegion);
    }
}
