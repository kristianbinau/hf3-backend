<?php

class Country extends AbstractOrm
{
    protected static string $table = 'countries';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->subRegion = SubRegion::retrieveByPK($this->sub_region_id);
    }
}
