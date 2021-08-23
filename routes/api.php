<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationItemController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDeliveryTypeController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegionSubRegionController;
use App\Http\Controllers\SubRegionController;
use App\Http\Controllers\SubRegionCountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('regions', RegionController::class)->except(['store', 'update', 'destroy']);
Route::apiResource('regions.sub-regions', RegionSubRegionController::class)->only(['index']);
Route::apiResource('sub-regions', SubRegionController::class)->except(['store', 'update', 'destroy']);
Route::apiResource('sub-regions.countries', SubRegionCountryController::class)->only(['index']);
Route::apiResource('countries', CountryController::class)->except(['store', 'update', 'destroy']);
Route::apiResource('cities', CityController::class)->except(['destroy']);
Route::apiResource('addresses', AddressController::class)->except(['destroy']);

Route::apiResource('items', ItemController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('products-types', ProductTypeController::class)->only(['index', 'show']);
Route::apiResource('manufacturers', ManufacturerController::class);

Route::apiResource('locations', LocationController::class);
Route::apiResource('locations.items', LocationItemController::class)->only(['index']);
Route::apiResource('locations.departments', DepartmentController::class)->shallow();
Route::apiResource('departments.employees', EmployeeController::class)->shallow();


Route::apiResource('orders', OrderController::class);
Route::apiResource('orders.items', OrderItemController::class)->only(['index', 'store']);
Route::apiResource('orders-items', OrderItemController::class)->except(['index', 'store']);
Route::apiResource('orders.discounts', OrderItemController::class)->only(['index', 'store']);
Route::apiResource('orders-discounts', OrderItemController::class)->except(['index', 'store']);
Route::apiResource('orders.deliveries', OrderItemController::class)->only(['index', 'store']);
Route::apiResource('orders-deliveries', OrderItemController::class)->except(['index', 'store']);
Route::apiResource('orders-deliveries-types', OrderDeliveryTypeController::class)->only(['index', 'show']);

Route::apiResource('customers', CustomerController::class);
Route::apiResource('customers.orders', CustomerOrderController::class)->only(['index']);
