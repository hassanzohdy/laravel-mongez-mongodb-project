<?php

declare(strict_types=1);

namespace App\Modules\Guests\Tests\Units;

use HZ\Illuminate\Mongez\Testing\Units\ObjectUnit;
use HZ\Illuminate\Mongez\Testing\Units\StringUnit;

class AccessTokenUnit extends ObjectUnit
{
    /**
     * Access Token Type
     *
     * @var string
     */
    protected string $accessTokenType = '';

    /**
     * Constructor
     */
    public function __construct(string $accessTokenType)
    {
        $this->accessTokenType = $accessTokenType;

        parent::__construct([
            'type' => (new StringUnit())->equal($this->accessTokenType),
            'accessToken' => new StringUnit(),
        ]);
    }
}
