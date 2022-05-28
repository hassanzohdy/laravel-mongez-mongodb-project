<?php

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\StringUnit;
use App\Modules\Users\Tests\Rules\IsUnauthenticated;

class UnauthenticatedUnit extends StringUnit
{
    /**
     * {@inheritDoc}
     */
    const NAME = 'Unauthenticated';

    /**
     * {@inheritdoc}
     */
    public function beforeValidation()
    {
        $this->addRules([
            new IsUnauthenticated(),
        ]);
    }
}
