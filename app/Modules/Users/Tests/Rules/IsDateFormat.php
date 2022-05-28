<?php

namespace App\Modules\Users\Tests\Rules;

use DateTime;
use HZ\Illuminate\Mongez\Testing\Rules\UnitRule;
use HZ\Illuminate\Mongez\Testing\UnitRuleInterface;

class IsDateFormat extends UnitRule implements UnitRuleInterface
{
    /**
     * {@inheritDoc}
     */
    const NAME = 'dateFormat';

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        return (bool) DateTime::createFromFormat('d-m-Y H:i:s A', $this->value);
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return ':key is expected to be d-m-Y H:i:s A, :valueType returned.';
    }
}
