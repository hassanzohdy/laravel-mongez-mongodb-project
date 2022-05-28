<?php

namespace App\Modules\Guests\Tests;

use HZ\Illuminate\Mongez\Testing\ApiTestCase;
use App\Modules\Guests\Tests\Units\AccessTokenUnit;
use App\Modules\Guests\Tests\Units\AuthorizationUnit;
use HZ\Illuminate\Mongez\Testing\StrictResponseSchema;

class GuestAccessTokenTest extends ApiTestCase
{
    /**
     * {@inheritDoc}
     */
    protected ?bool $isAuthenticated = false;

    /**
     * Test Access token for ios
     *
     * @return void
     */
    public function testIosGuestAccessToken()
    {
        $this->assertAccessTokenFor('ios', 'ios');
    }

    /**
     * Test Access token for android
     *
     * @return void
     */
    public function testAndroidGuestAccessToken()
    {
        $this->assertAccessTokenFor('android', 'android');
    }

    /**
     * Test Access token for web ui
     *
     * @return void
     */
    public function testWebUiGuestAccessToken()
    {
        $this->assertAccessTokenFor('wui', 'wui');
    }

    /**
     * Test Access token for admin web ui
     *
     * @return void
     */
    public function testAdminWebUiGuestAccessToken()
    {
        $this->assertAccessTokenFor('awui', 'awui');
    }

    /**
     * Generate an access token for the given application type
     *
     * @param  string $application
     * @param  string $os
     * @return \HZ\Illuminate\Mongez\Testing\TestResponse
     */
    protected function assertAccessTokenFor(string $application, string $os)
    {
        static::$apiKey = config('auth.apiKeys.' . $application);

        $response = $this->post('login/guests', [], [
            'os' => $os,
        ]);

        $response->assertSuccess();

        $responseSchema = new StrictResponseSchema([
            'authorization' => new AccessTokenUnit('guest'),
        ]);

        $response->assertResponse($responseSchema);

        return $response;
    }

    /**
     * Test Invalid Access for missing os header
     *
     * @return void
     */
    public function testInvalidAccessTokenForMissingOsHeader()
    {
        $response = $this->post('login/guests', [], []);

        $response->assertUnauthorized();

        $responseSchema = new StrictResponseSchema([
            'error' => ['string', 'equal:Invalid API Key.'],
        ]);

        $response->assertResponse($responseSchema);
    }

    /**
     * Test Invalid Access for Authorization header
     *
     * @return void
     */
    public function testInvalidAccessTokenForMissingAuthorizationHeader()
    {
        $isAuthenticated = $this->isAuthenticated;
        // setting it to null will disable adding
        // the Authorization header to headers list
        $this->isAuthenticated = null;
        $response = $this->post('login/guests', [], []);

        $response->assertUnauthorized();

        $responseSchema = new StrictResponseSchema([
            'error' => ['string', 'equal:Invalid API Key.'],
        ]);

        $response->assertResponse($responseSchema);

        $this->isAuthenticated = $isAuthenticated;
    }

    /**
     * Test Invalid Access Token for ios based
     *
     * @return void
     */
    public function testInvalidIosGuestAccessToken()
    {
        $this->assertInvalidAccessTokenFor('ios');
    }

    /**
     * Test generating guest access token
     */
    public function testGeneratingAccessTokenForGuest()
    {
        $response = $this->post('/login/guests', [], [
            'os' => 'ios',
            'Authorization' => 'key ' . config('auth.apiKeys.ios'),
        ]);

        $response->assertSuccess();

        $response->assertResponse(new StrictResponseSchema([
            'authorization' => new AuthorizationUnit(),
        ]));
    }

    /**
     * Assert invalid access token generated for the given application
     * Because eof the invalid os value
     *
     * @param  string $application
     * @return \HZ\Illuminate\Mongez\Testing\TestResponse
     */
    protected function assertInvalidAccessTokenFor(string $application)
    {
        static::$apiKey = config('auth.apiKeys.' . $application);

        $response = $this->post('login/guests', [], [
            'os' => $this->faker->text(),
        ]);

        $response->assertUnauthorized();

        $responseSchema = new StrictResponseSchema([
            'error' => ['string', 'equal:Invalid API Key.'],
        ]);

        $response->assertResponse($responseSchema);

        return $response;
    }
}
