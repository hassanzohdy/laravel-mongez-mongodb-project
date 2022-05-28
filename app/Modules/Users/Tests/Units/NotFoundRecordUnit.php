<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;

class NotFoundRecordUnit extends ObjectUnit
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->setUnits([
            'key' => (new StringUnit())->equal('error'),
            'value' => (new StringUnit())->equal(trans('response.notFound')),
        ]);
    }
}
