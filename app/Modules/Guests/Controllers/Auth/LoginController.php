<?php

namespace App\Modules\Guests\Controllers\Auth;

use Illuminate\Http\Request;
use HZ\Illuminate\Mongez\Http\ApiController;

class LoginController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'guests';

    /**
     * Login guest into system.
     *
     * @param Request $request
     * @return string
     */
    public function login(Request $request)
    {
        return $this->success($this->repository->firstOrCreate($request));
    }
}
