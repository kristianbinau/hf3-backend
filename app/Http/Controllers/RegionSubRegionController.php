<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\SubRegion;
use Illuminate\Http\Request;

class RegionSubRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *      path="/api/region/{regionId}/sub-regions",
     *      operationId="RegionSubRegionController.index",
     *      tags={"Addresses"},
     *      summary="Get list of sub regions in region",
     *      description="Returns list of sub regions in region",
     *      @OA\Parameter(
     *          name="regionId",
     *          description="Region Id",
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
    public function index(Region $region)
    {
        return Response($region->subRegions()->paginate(500));
    }
}
