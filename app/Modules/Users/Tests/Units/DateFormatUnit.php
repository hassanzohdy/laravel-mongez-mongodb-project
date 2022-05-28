<?php

namespace App\Modules\Users\Tests\Units;

use App\Modules\Users\Tests\Rules\IsDateFormat;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;

class DateFormatUnit extends StringUnit
{
    /**
     * {@inheritDoc}
     */
    const NAME = 'dateFormat';

    /**
     * {@inheritdoc}
     */
    protected function init()
    {
        parent::init();

        $this->addRules([
            new IsDateFormat(),
        ]);
    }
}
