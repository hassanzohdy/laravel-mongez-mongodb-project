<?php

declare(strict_types=1);

namespace App\Modules\Guests\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;

class AuthorizationUnit extends ObjectUnit
{
    /**
     * {@inheritDoc}
     */
    public function beforeValidation()
    {
        $this->setUnits([
            'type' => (new StringUnit())->equal('guest'),
            'accessToken' => new StringUnit(),
        ]);
    }
}
