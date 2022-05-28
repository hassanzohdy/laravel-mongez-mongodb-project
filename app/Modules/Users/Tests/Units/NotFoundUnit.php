<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ArrayOfUnit;

class NotFoundUnit extends ArrayOfUnit
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct(NotFoundRecordUnit::class);
    }
}
