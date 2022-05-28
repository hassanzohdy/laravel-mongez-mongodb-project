<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use function user;
use function trans;
use Illuminate\Support\MessageBag;
use HZ\Illuminate\Mongez\Http\ApiController;

class LogoutController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * Admin logout.
     *
     * @return string
     */
    public function logout()
    {
        return user()->currentAccessToken()->delete() ? $this->success() :  $this->badRequest((new MessageBag())->add('auth', trans('auth.logout-failed')));
    }
}
