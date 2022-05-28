<?php

namespace App\Modules\Guests\Traits\Tests;

trait WithGuestAccessToken
{
    /**
     * os type
     *
     * @var string
     */
    protected string $osType = 'ios';

    /**
     * Get access token settings
     *
     * @return array
     */
    protected function accessTokenSettings(): array
    {
        $settings = parent::accessTokenSettings();

        return array_merge($settings, [
            'headers' => [
                'Authorization' => 'key ' . config('auth.apiKeys.' . $this->osType),
            ],
        ]);
    }

    /**
     * Append more headers to each request
     *
     * @return array
     */
    public function appendHeaders(): array
    {
        return [
            'os' => $this->osType,
        ];
    }
}
