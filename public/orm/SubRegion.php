<?php

class SubRegion extends AbstractOrm
{
    protected static string $table = 'sub_regions';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->region = Region::retrieveByPK($this->region_id);
    }
}
