<?php

/**
 * Only necessary because of lack of autoloader.
 */
require_once('orm/IAbstractOrm.php');
require_once('orm/AbstractOrm.php');
require_once('orm/Address.php');
require_once('orm/City.php');
require_once('orm/Country.php');
require_once('orm/Customer.php');
require_once('orm/Department.php');
require_once('orm/Employee.php');
require_once('orm/Item.php');
require_once('orm/Location.php');
require_once('orm/Login.php');
require_once('orm/Manufactor.php');
require_once('orm/Order.php');
require_once('orm/OrderDelivery.php');
require_once('orm/OrderDeliveryType.php');
require_once('orm/OrderDiscount.php');
require_once('orm/OrderItem.php');
require_once('orm/Product.php');
require_once('orm/ProductType.php');
require_once('orm/Region.php');
require_once('orm/SubRegion.php');


// Create connection MySQL server.
AbstractOrm::setConn();


// Example 1

$order = Order::retrieveByPK(2);
foreach ($order->orderItems as $orderItem) {
    $item = Item::retrieveByPK($orderItem->item_id);
    $product = Product::retrieveByPK($item->product_id);
    echo $product->name;
}



// Example 2
$address = Address::retrieveByPK(1);
echo 'Road: ' . $address->road . ' - ';
echo 'Road Num: ' . $address->road_num . ' - ';
echo 'Region Name: ' . $address->city->country->subRegion->region->name;

//$product = Product::retrieveByField('name', 'James');
