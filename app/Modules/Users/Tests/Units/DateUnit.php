<?php

declare(strict_types=1);

namespace App\Modules\Users\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\IntUnit;
use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;

class DateUnit extends ObjectUnit
{
    public function init()
    {
        parent::init();

        $this->setUnits([
            'format' => new DateFormatUnit(),
            'timestamp' => new IntUnit(),
            'humanTime' => new StringUnit(),
            'text' => new StringUnit(),
        ]);
    }
}
