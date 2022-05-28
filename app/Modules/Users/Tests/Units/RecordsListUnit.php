<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ArrayOfUnit;

class RecordsListUnit extends ArrayOfUnit
{
    /**
     * {@inheritDoc}
     */
    public function __construct(string $singleRecordUnit)
    {
        parent::__construct($singleRecordUnit);
    }
}
