<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use HZ\Illuminate\Mongez\Http\ApiController;

class ResetPasswordController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * reset user password
     *
     * @param Request $request
     * @return string
     */
    public function resetPassword(Request $request)
    {
        $validator = $this->scan($request);

        if (!$validator->passes()) {
            return $this->badRequest($validator->errors());
        }

        $user = $this->repository->getByModel('resetPasswordCode', (int) $request->code);

        if (!$user) {
            return $this->badRequest(trans('auth.invalidResetCode'));
        }

        $user->resetPasswordCode = null;

        $user->updatePassword($request->password);

        return $this->success([
            'record' => $this->repository->wrap($user),
        ]);
    }

    /**
     * Determine whether the passed values are valid
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function scan(Request $request)
    {
        return Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'code' => 'required|numeric',
        ]);
    }
}
