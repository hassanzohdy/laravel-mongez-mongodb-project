<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;
use HZ\Illuminate\Mongez\Testing\Units\ArrayOfUnit;

class UserGroupUnit extends ObjectUnit
{
    /**
     * {@inheritdoc}
     */
    public function beforeValidation()
    {
        $this->setUnits([
            'id' => 'id',
            'name' => 'string',
            'published' => 'boolean',
            'permissions' => new ArrayOfUnit(StringUnit::class),
        ]);
    }
}
