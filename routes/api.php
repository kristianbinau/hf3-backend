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

Route::middleware('auth:sanctum')->apiResource('regions', RegionController::class)->except(['store', 'update', 'destroy']);
Route::middleware('auth:sanctum')->apiResource('region.sub-regions', RegionSubRegionController::class)->only(['index']);
Route::middleware('auth:sanctum')->apiResource('sub-regions', SubRegionController::class)->except(['store', 'update', 'destroy']);
Route::middleware('auth:sanctum')->apiResource('sub-region.countries', SubRegionCountryController::class)->only(['index']);
Route::middleware('auth:sanctum')->apiResource('countries', CountryController::class)->except(['store', 'update', 'destroy']);
Route::middleware('auth:sanctum')->apiResource('cities', CityController::class)->except(['destroy']);
Route::middleware('auth:sanctum')->apiResource('addresses', AddressController::class)->except(['destroy']);

Route::middleware('auth:sanctum')->apiResource('items', ItemController::class);
Route::middleware('auth:sanctum')->apiResource('products', ProductController::class);
Route::middleware('auth:sanctum')->apiResource('product-types', ProductTypeController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->apiResource('manufacturers', ManufacturerController::class);

Route::middleware('auth:sanctum')->apiResource('locations', LocationController::class);
Route::middleware('auth:sanctum')->apiResource('location.items', LocationItemController::class)->only(['index']);
Route::middleware('auth:sanctum')->apiResource('location.departments', DepartmentController::class)->shallow();
Route::middleware('auth:sanctum')->apiResource('department.employees', EmployeeController::class)->shallow();


Route::middleware('auth:sanctum')->apiResource('orders', OrderController::class);
Route::middleware('auth:sanctum')->apiResource('order.items', OrderItemController::class)->only(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order-items', OrderItemController::class)->except(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order.discounts', OrderItemController::class)->only(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order-discounts', OrderItemController::class)->except(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order.deliveries', OrderItemController::class)->only(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order-deliveries', OrderItemController::class)->except(['index', 'store']);
Route::middleware('auth:sanctum')->apiResource('order-delivery-types', OrderDeliveryTypeController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->apiResource('customers', CustomerController::class);
Route::middleware('auth:sanctum')->apiResource('customer.orders', CustomerOrderController::class)->only(['index']);
