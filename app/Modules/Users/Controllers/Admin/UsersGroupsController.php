<?php

namespace App\Modules\Users\Controllers\Admin;

use HZ\Illuminate\Mongez\Http\RestfulApiController;

class UsersGroupsController extends RestfulApiController
{
    /**
     * Controller info
     *
     * @var array
     */
    protected $controllerInfo = [
        'repository' => 'usersGroups',
        'listOptions' => [
            'select' => [],
            'paginate' => null, // inherit by default
        ],
        'rules' => [
            'all' => [],
            'store' => [],
            'update' => [],
            'patch' => [],
        ],
    ];
}
