<?php

namespace App\Modules\Users\Contracts;

interface AccountInterface
{
    /**
     * Get user account type
     *
     * @return string
     */
    public function accountType(): string;

    /**
     * Get shared info data of user
     *
     * @return array
     */
    public function sharedInfo(): array;

    /**
     * Get customer id.
     *
     * @return int
     */
    public function getAccountId(): int;
}
