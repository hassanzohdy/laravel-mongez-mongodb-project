<?php

namespace App\Modules\Users\Traits\Tests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

trait WithUserAccessToken
{
    /**
     * os type
     *
     * @var string
     */
    protected string $osType = 'ios';

    /**
     * Customer access token response
     *
     * @var array
     */
    protected array $accessTokenResponse = [];

    /**
     * Customer Credentials
     *
     * @var array
     */
    protected static array $credentials = [];

    /**
     * Get account type
     *
     * @return string
     */
    protected function getAccountType(): string
    {
        return 'user';
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        if ($this->accessTokenResponse && $this->accessTokenResponse['type'] === $this->getAccountType()) {
            return $this->accessTokenResponse['accessToken'];
        }

        $this->instantMessage('Generating Guest Access Token...', 'cyan');

        $guestResponse = parent::postJson('/login/guests', [], [
            'os' => $this->osType,
            'Authorization' => "key " . config('auth.apiKeys.' . $this->osType),
        ]);

        $guestAccessToken = $guestResponse->body()->data->authorization->accessToken;

        $this->instantMessage('Generating ' . $accountType = ucfirst($this->getAccountType()) . ' Access Token...', 'cyan');

        // make sure to refresh the application to not stuck with old requests
        $this->refreshApplication();

        $response = $this->generateUserAccessToken($guestAccessToken);

        $this->accessTokenResponse = $response->toArray()['data']['authorization'];

        $this->isAuthenticated = true;

        $this->instantMessage($accountType . ' Access Token Has been generated successfully...', 'green');

        return $this->accessTokenResponse['accessToken'];
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

    protected function generateUserAccessToken(string $guestAccessToken)
    {
        return parent::postJson('admin/login', $this->getCredentials(), [
            'os' => 'ios',
            'Authorization' => 'Bearer ' . $guestAccessToken,
        ]);
    }

    /**
     * Get account credentials.
     *
     * @return array
     * @throws FileNotFoundException
     */
    protected function getCredentials(): array
    {
        if (empty(static::$credentials)) {
            static::$credentials = json_decode(Storage::disk('public')->get("{$this->getAccountType()}-credentials.json"), true);
        }

        return static::$credentials;
    }
}
