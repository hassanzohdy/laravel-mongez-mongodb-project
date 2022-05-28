<?php

namespace App\Modules\Users\Tests\Rules;

use HZ\Illuminate\Mongez\Testing\Rules\UnitRule;
use HZ\Illuminate\Mongez\Testing\UnitRuleInterface;

class IsUnauthenticated extends UnitRule implements UnitRuleInterface
{
    /**
     * {@inheritDoc}
     */
    const NAME = 'isUnauthenticated';

    /**
     * @var string
     */
    protected string $validValue = 'Unauthenticated.';

    /**
     * {@inheritDoc}
     */
    public function isValid(): bool
    {
        return $this->value === $this->validValue;
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return ":key is expected to be '{$this->validValue}' A, :value returned.";
    }
}
