<?php

namespace App\Modules\Users\Controllers\Site;

use Illuminate\Http\Request;
use HZ\Illuminate\Mongez\Http\ApiController;

class UsersController extends ApiController
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
    public function index(Request $request)
    {
        $options = [];

        $response = [
            'records' => $this->repository->listPublished($options),
        ];

        if ($this->repository->getPaginateInfo()) {
            $response['paginationInfo'] = $this->repository->getPaginateInfo();
        }

        return $this->success($response);
    }

    /**
     * {@inheritDoc}
     */
    public function show($id, Request $request)
    {
        $record = $this->repository->getPublished($id);

        if (!$record) {
            return $this->notFound('notFoundRecord');
        }

        return $this->success([
            'record' => $record,
        ]);
    }
}
