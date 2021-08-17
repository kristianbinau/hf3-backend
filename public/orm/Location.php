<?php

class Location extends AbstractOrm
{
    protected static string $table = 'locations';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->departments = Department::retrieveByField('location_id', $this->id);
    }
}
