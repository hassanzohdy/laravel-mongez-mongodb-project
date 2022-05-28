<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Modules\Customers\Jobs\SendEmailJop;
use HZ\Illuminate\Mongez\Http\ApiController;

class ForgetPasswordController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * check email is exists and send code for rest password
     *
     * @param Request $request
     * @return string
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if (!$validator->passes()) {
            return $this->badRequest($validator->errors());
        }

        $user = $this->repository->getByModel('email', $request->email);
        $resetPasswordCode = mt_rand(1000, 9999);
        $user->resetPasswordCode = $resetPasswordCode;
        $user->save();

        $data = ['code' => $resetPasswordCode, 'email' => $request->email];

        dispatch(new SendEmailJop($data));

        return $this->success();
    }
}
