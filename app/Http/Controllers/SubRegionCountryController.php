<?php

namespace App\Http\Controllers;

use App\Models\SubRegion;
use Illuminate\Http\Request;

class SubRegionCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/sub-regions/{subRegionId}/countries",
     *      operationId="SubRegionCountryController.index",
     *      tags={"Addresses"},
     *      summary="Get list of countries in sub regions",
     *      description="Returns list of countries in sub regions",
     *      @OA\Parameter(
     *          name="subRegionId",
     *          description="Sub region Id",
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
    public function index(SubRegion $subRegion)
    {
        error_log(print_r($subRegion->name, true));
        return Response($subRegion->countries()->paginate(500));
    }
}
