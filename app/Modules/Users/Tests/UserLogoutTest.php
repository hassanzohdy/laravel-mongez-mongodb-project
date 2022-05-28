<?php

namespace App\Modules\Users\Tests;

use HZ\Illuminate\Mongez\Testing\ApiTestCase;
use HZ\Illuminate\Mongez\Testing\Units\BooleanUnit;
use HZ\Illuminate\Mongez\Testing\StrictResponseSchema;
use App\Modules\Users\Traits\Tests\WithUserAccessToken;

class UserLogoutTest extends ApiTestCase
{
    use WithUserAccessToken;

    /**
     * {@inheritDoc}
     */
    protected ?bool $isAuthenticated = true;

    /**
     * Test user failed logout without authorization data
     */
    public function testUserFailedLogoutWithoutAuthorization()
    {
        $response = $this->post('/admin/logout', [], [
            'os' => $this->faker->text,
            'Authorization' => $this->faker->text,
        ]);

        $response->assertUnauthorized();

        $responseSchema = new StrictResponseSchema([
            'error' => 'string',
        ]);

        $response->assertResponse($responseSchema);
    }

    /**
     * Test user logout
     */
    public function testUserLogout()
    {
        $response = $this->post('/admin/logout', []);

        $response->assertSuccess();

        $responseSchema = new StrictResponseSchema([
            'success' => new BooleanUnit(),
        ]);

        $response->assertResponse($responseSchema);
    }
}
