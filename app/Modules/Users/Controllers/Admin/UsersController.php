<?php

namespace App\Modules\Users\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;
use App\Modules\Users\Database\Seeders\UserSeeder;
use HZ\Illuminate\Mongez\Http\RestfulApiController;

class UsersController extends RestfulApiController
{
    /**
     * Controller info
     *
     * @var array
     */
    protected $controllerInfo = [
        'repository' => 'users',
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

    /**
     * seed database to insert admin
     *
     * @return int
     */
    public function seedDefaultAdmin()
    {
        return Artisan::call('db:seed', [
            '--class' => UserSeeder::class,
        ]);
    }
}
