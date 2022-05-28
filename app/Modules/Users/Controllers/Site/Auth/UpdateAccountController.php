<?php

namespace App\Modules\Users\Controllers\Site\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use HZ\Illuminate\Mongez\Http\ApiController;

class UpdateAccountController extends ApiController
{
    /**
     * Repository name
     *
     * @var string
     */
    public const REPOSITORY_NAME = 'users';

    /**
     * {@inheritDoc}
     */
    public function updateProfile(Request $request)
    {
        $validator = $this->scan($request);

        $user = user();
        if (!$validator->passes()) {
            return $this->badRequest($validator->errors());
        }

        $user = $this->repository->update($user->id, $request);

        return $this->success([
            'record' => $this->repository->wrap($user),
        ]);
    }

    /**
     * Determine whether the passed values are valid
     *
     * @return mixed
     */
    protected function scan(Request $request)
    {
        $user = user();

        $table = $this->repository->getTableName();

        return Validator::make($request->all(), [
            'name' => 'required|min:4',
            'password' => 'confirmed|min:8',
            'email' => [
                'required',
                "unique:${table},email,{$user->email},email",
            ],
            'phoneNumber' => [
                'required',
                "unique:${table},phoneNumber,{$user->phoneNumber},phoneNumber",
            ],
        ]);
    }

    /**
     * update password
     * @param Request $request
     * @return Response|string
     * @throws NotFoundRepositoryException
     */
    public function updatePassword(Request $request)
    {
        $customer = user();
        // $repository = repo(config('app.users-repo'));

        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'password' => 'min:8|confirmed',
        ]);

        if (!$validator->passes()) {
            return $this->badRequest($validator->errors());
        } else {
            if (!$customer->isMatchingPassword($request->oldPassword)) {
                return $this->badRequest(trans('auth.invalidPassword'));
            }

            $customer->updatePassword($request->password);
        }

        return $this->success([
            'record' => $this->repository->wrap($customer),
        ]);
    }

    /**
     * Get profile info
     *
     * @return mixed
     */
    public function me()
    {
        $user = user();

        return $this->success([
            'record' => $this->repository->wrap($user),
        ]);
    }
}
