<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;

class UserUnit extends ObjectUnit
{
    /**
     * {@inheritdoc}
     */
    public function beforeValidation()
    {
        $this->setUnits([
            'id' => 'id',
            'name' => 'string',
            'email' => 'email',
            'phoneNumber' => 'string',
            'published' => 'boolean',
            // 'group' => new UserGroupUnit(),
        ]);
    }
}
