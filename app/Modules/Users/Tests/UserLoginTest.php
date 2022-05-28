<?php

namespace App\Modules\Users\Tests;

use App\Modules\Users\Tests\Units\UserUnit;
use HZ\Illuminate\Mongez\Testing\ApiTestCase;
use App\Modules\Guests\Tests\Units\AccessTokenUnit;
use HZ\Illuminate\Mongez\Testing\StrictResponseSchema;
use HZ\Illuminate\Mongez\Testing\Units\ErrorsListUnit;
use App\Modules\Guests\Traits\Tests\WithGuestAccessToken;

class UserLoginTest extends ApiTestCase
{
    use WithGuestAccessToken;

    /**
     * {@inheritDoc}
     */
    protected ?bool $isAuthenticated = true;

    //    /**
    //     * Test user success login
    //     */
    //    public function testSuccessUserLogin()
    //    {
    //        $response = $this->post('/admin/login', [
    //            'email' => $this->credentials['email'],
    //            'password' => $this->credentials['password'],
    //        ]);
    //
    //        $responseSchema = new ResponseSchema([
    //            'authorization' => new AccessTokenUnit('user'),
    //            'record' => new UserUnit(),
    //        ]);
    //
    //        $response->assertSuccess();
    //
    //        $response->assertResponse($responseSchema);
    //    }

    /**
     * Test user failed login without passing authorization data
     */
    public function testFailedUserLoginWithoutAuthorization()
    {
        $response = $this->post('/admin/login', [
            'email' => 'hassanzohdy@gmail.com',
            'password' => '123123123',
        ], [
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
     * Test user failed login without passing any data
     */
    public function testFailedUserLoginWithoutAnyData()
    {
        $response = $this->post('/admin/login', []);

        $response->assertBadRequest();

        $response->assertResponse(new StrictResponseSchema([
            'errors' => new ErrorsListUnit(['email', 'password']),
        ]));
    }

    /**
     * Test user failed login with invalid email
     */
    public function testFailedUserLoginWitInvalidEmail()
    {
        $response = $this->post('/admin/login', [
            'email' => $this->faker->text(),
            'password' => '123123123',
        ]);

        $response->assertBadRequest();

        $response->assertResponse(new StrictResponseSchema([
            'errors' => new ErrorsListUnit(['email']),
        ]));
    }

    /**
     * Test user failed login with invalid password
     */
    public function testFailedUserLoginWitInvalidPassword()
    {
        $response = $this->post('/admin/login', [
            'email' => 'hassanzohdy@gmail.com',
            'password' => $this->faker->password(9),
        ]);

        $response->assertBadRequest();

        $response->assertResponse(new StrictResponseSchema([
            'errors' => new ErrorsListUnit(['email']),
        ]));
    }

    /**
     * Test user failed login with invalid login
     */
    public function testUserInvalidLoginData()
    {
        $response = $this->post('/login', [
            'email' => $this->faker->text(),
            'password' => $this->faker->password(9),
        ]);

        $response->assertBadRequest();

        $response->assertResponse(new StrictResponseSchema([
            'errors' => new ErrorsListUnit(['email']),
        ]));
    }
}
