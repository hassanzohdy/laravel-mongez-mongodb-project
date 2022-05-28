<?php

namespace App\Modules\Users\Tests;

use App\Modules\Users\Tests\Units\UserUnit;
use HZ\Illuminate\Mongez\Testing\ApiTestCase;
use HZ\Illuminate\Mongez\Testing\ResponseSchema;
use HZ\Illuminate\Mongez\Testing\StrictResponseSchema;
use HZ\Illuminate\Mongez\Testing\Units\ErrorsListUnit;
use App\Modules\Users\Traits\Tests\WithUserAccessToken;

class UserUpdatePasswordTest extends ApiTestCase
{
    use WithUserAccessToken;

    /**
     * {@inheritDoc}
     */
    protected ?bool $isAuthenticated = true;

    /**
     * Test user success update password
     */
    public function testSuccessUserUpdatePassword()
    {
        $response = $this->post('/admin/update-password', [
            'oldPassword' => $this->getCredentials()['password'],
            'password' => $this->getCredentials()['password'],
            'password_confirmation' => $this->getCredentials()['password'],
        ]);

        $responseSchema = new ResponseSchema([
            'user' => new UserUnit(),
        ]);

        $response->assertSuccess();

        $response->assertResponse($responseSchema);
    }

    /**
     * Test user failed update password without sending any data
     */
    public function testFailedUserUpdatePasswordWithoutSendingAnyData()
    {
        $response = $this->post('/admin/update-password', []);

        $response->assertBadRequest();

        $response->assertResponse(new StrictResponseSchema([
            'errors' => new ErrorsListUnit(['oldPassword']),
        ]));
    }

    /**
     * Test user failed update password without passing authorization data
     */
    public function testFailedUserUpdatePasswordWithoutAuthorization()
    {
        $this->isAuthenticated = null;
        
        $response = $this->post('/admin/update-password', [
            'oldPassword' => $this->getCredentials()['password'],
            'password' => $password = $this->faker->password(8),
            'password_confirmation' => $password,
        ]);

        $response->assertUnauthorized();

        $responseSchema = new StrictResponseSchema([
            'error' => 'string',
        ]);

        $response->assertResponse($responseSchema);
    }
}
