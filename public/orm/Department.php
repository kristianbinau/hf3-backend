<?php

class Department extends AbstractOrm
{
    protected static string $table = 'departments';

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->employees = Employee::retrieveByField('department_id', $this->id);
    }
}
