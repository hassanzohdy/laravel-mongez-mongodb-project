<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use function trans;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use HZ\Illuminate\Mongez\Http\ApiController;

class LoginController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * Admin login.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|string
     */
    public function login(Request $request)
    {
        // make the validation
        $validator = $this->scan($request);

        if ($validator->fails()) {
            return $this->badRequest($validator->errors());
        }

        $user = $this->repository->findForLogin($request->only(['email', 'password']));

        if (!$user) {
            return $this->badRequest((new MessageBag())->add('email', trans('auth.failed')));
        }

        return $this->success([
            'authorization' => $user->generateToken(),
            'record' => $this->repository->wrap($user),
        ]);
    }

    /**
     * Determine whether the passed values are valid
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function scan(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    }
}
