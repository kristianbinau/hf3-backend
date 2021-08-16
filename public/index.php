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
$emptyProductType->description = 'James is cool';
$emptyProductType->save();
echo $emptyProductType->id;
echo $emptyProductType->name;
$emptyProductType->name = 'BEBEBEBEBE';
$emptyProductType->save();

$productType3 = ProductType::retrieveByPK($emptyProductType->id);

echo $productType3->id;
echo $productType3->name;

$productType3->delete();
