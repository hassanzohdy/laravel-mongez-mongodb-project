<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use function trans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use HZ\Illuminate\Mongez\Http\ApiController;

class VerifyResetPasswordCodeController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * verify code is valid to rest user password
     *
     * @param Request $request
     * @return string
     */
    public function verifyCode(Request $request)
    {
        $validator = $this->scan($request);

        if (!$validator->passes()) {
            return $this->badRequest($validator->errors());
        }

        $user = $this->repository->getBy('email', $request->email);

        if ($user->resetPasswordCode != $request->code || $user->resetPasswordCode == 0) {
            return $this->badRequest(trans('auth.invalidResetCode'));
        }

        return $this->success();
    }

    /**
     * Determine whether the passed values are valid
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function scan(Request $request)
    {
        return Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'code' => 'required|numeric',
        ]);
    }
}
