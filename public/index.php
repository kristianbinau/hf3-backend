<?php

require('ProductType.php');

AbstractOrm::setConn();

$productType = ProductType::retrieveByPK(1);

echo $productType->id;
echo $productType->name;

$productType2 = ProductType::retrieveByField('name', $productType->name);

echo $productType2->id;
echo $productType2->name;
