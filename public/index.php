<?php

require('ProductType.php');

AbstractOrm::setConn();

$productType = ProductType::retrieveByPK(51);

echo $productType->id;
echo $productType->name;

$productTypes2 = ProductType::retrieveByField('name', $productType->name);

foreach($productTypes2 as $productType2) {
    echo $productType2->id;
    echo $productType2->name;
}

$emptyProductType = new ProductType();
$emptyProductType->name = 'James';
echo $emptyProductType->name;
$emptyProductType->save();

