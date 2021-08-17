<?php

class Address extends AbstractOrm
{
    protected static string $table = 'addresses';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->city = City::retrieveByPK($this->city_id);
    }
}
