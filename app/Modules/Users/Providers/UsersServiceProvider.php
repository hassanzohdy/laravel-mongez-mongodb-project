<?php

namespace App\Modules\Users\Providers;

use HZ\Illuminate\Mongez\Providers\ModuleServiceProvider;

class UsersServiceProvider extends ModuleServiceProvider
{
    /**
     * List of routes files
     *
     * @const array
     */
    const ROUTES_TYPES = ['admin', 'site'];

    /**
     * Module build type
     * Possible values: api|ui
     *
     * @const strong
     */
    const BUILD_MODE = 'api';

    /**
     * Translation Name Prefix
     *
     * @const string
     */
    public const TRANSLATION_PREFIX = 'users';
}
