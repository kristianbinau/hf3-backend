<?php

require('AbstractOrm.php');

class ProductType extends AbstractOrm
{
    protected static string $table = 'product_types';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        // TODO: Implement initialise() method.
    }
}
