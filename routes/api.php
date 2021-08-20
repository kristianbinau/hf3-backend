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
use App\Http\Controllers\OrderDeliveryController;
use App\Http\Controllers\OrderDeliveryTypeController;
use App\Http\Controllers\OrderDiscountController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SubRegionController;
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

Route::apiResource('addresses', AddressController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('counties', CountryController::class);
Route::apiResource('subregions', SubRegionController::class);
Route::apiResource('regions', RegionController::class);

Route::apiResource('items', ItemController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('products.types', ProductTypeController::class);
Route::apiResource('productsTypes', ProductTypeController::class);
Route::apiResource('manufacturers', ManufacturerController::class);

Route::apiResource('locations', LocationController::class);
Route::apiResource('locations.departments', DepartmentController::class)->shallow();;
Route::apiResource('locations.departments.employees', EmployeeController::class)->shallow();;
Route::apiResource('locations.items', LocationItemController::class);

Route::apiResource('orders', OrderController::class);
Route::apiResource('orders.items', OrderItemController::class)->shallow();
Route::apiResource('orders.discounts', OrderDiscountController::class)->shallow();
Route::apiResource('orders.deliveries', OrderDeliveryController::class)->shallow();
Route::apiResource('orders.deliveries.types', OrderDeliveryTypeController::class);
Route::apiResource('ordersDeliveriesTypes', OrderDeliveryTypeController::class);

Route::apiResource('customers', CustomerController::class);
Route::apiResource('customers.orders', CustomerOrderController::class)->shallow();
