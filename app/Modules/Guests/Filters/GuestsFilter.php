<?php

namespace App\Modules\Guests\Filters;

use HZ\Illuminate\Mongez\Database\Filters\MongoDBFilter;

class GuestsFilter extends MongoDBFilter
{
    /**
     * List with all filter.
     *
     * filterName => functionName
     * @const array
     */
    const FILTER_MAP = [];
}
