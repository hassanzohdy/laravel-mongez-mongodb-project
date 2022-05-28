<?php

namespace App\Modules\Users\Traits;

trait TokenGenerator
{
    /**
     * Generate access token and response with the plain text token and user type.
     *
     * @param string|null $name
     * @param array $permissions
     * @return array
     */
    public function generateToken(string $name = null, array $permissions = []): array
    {
        return [
            'type' => $this->accountType(),
            'accessToken' => $this->createToken($name ?: $this->deviceId ?? $this->email, $permissions)->plainTextToken,
        ];
    }
}
