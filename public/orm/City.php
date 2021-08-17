<?php

class City extends AbstractOrm
{
    protected static string $table = 'cities';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->country = Country::retrieveByPK($this->country_id);
    }
}
