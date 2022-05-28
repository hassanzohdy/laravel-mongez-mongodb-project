<?php

namespace App\Modules\Guests\Controllers\Admin;

use HZ\Illuminate\Mongez\Http\RestfulApiController;

class GuestsController extends RestfulApiController
{
    /**
     * Controller info
     *
     * @var array
     */
    protected $controllerInfo = [
        'repository' => 'guests',
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
