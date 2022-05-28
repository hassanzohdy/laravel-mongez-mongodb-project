<?php

namespace App\Modules\Users\Tests;

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Storage;
use HZ\Illuminate\Mongez\Testing\ApiTestCase;
use App\Modules\Guests\Traits\Tests\WithGuestAccessToken;

class GetUserCredentialsTest extends ApiTestCase
{
    use WithGuestAccessToken;

    /**
     * {@inheritDoc}
     */
    protected ?bool $isAuthenticated = true;

    /**
     * Create new user account and save credentials.
     *
     * @return void
     */
    public function testGetUserCredentials()
    {
        $password = $this->faker->password;

        User::factory()->create([
            'email' => $email = $this->faker->safeEmail(),
            'password' => bcrypt($password),
        ]);

        $credentials = json_encode(['email' => $email, 'password' => $password]);

        Storage::disk('public')->put('user-credentials.json', $credentials);
    }
}
