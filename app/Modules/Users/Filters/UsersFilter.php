<?php

namespace App\Modules\Users\Filters;

use HZ\Illuminate\Mongez\Database\Filters\MongoDBFilter;

class UsersFilter extends MongoDBFilter
{
    /**
     * List with all filter.
     *
     * filterName => functionName
     * @const array
     */
    const FILTER_MAP = [];
}
