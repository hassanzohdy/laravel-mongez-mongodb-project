<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\UsersGroup;
use App\Modules\Users\Filters\UsersGroupsFilter;
use App\Modules\Users\Resources\UsersGroupResource;
use HZ\Illuminate\Mongez\Repository\RepositoryInterface;
use HZ\Illuminate\Mongez\Repository\MongoDBRepositoryManager;

class UsersGroupsRepository extends MongoDBRepositoryManager implements RepositoryInterface
{
    /**
     * Repository Name
     *
     * @const string
     */
    const NAME = 'usersGroups';

    /**
     * Model class name
     *
     * @const string
     */
    const MODEL = UsersGroup::class;

    /**
     * Resource class name
     *
     * @const string
     */
    const RESOURCE = UsersGroupResource::class;

    /**
     * Set the columns of the data that will be auto filled in the model
     * Please use the following data types for more convenient data types
     *
     * @const array
     */
    const DATA = ['name'];

    /**
     * Set columns list of string values.
     *
     * @cont array
     */
    const STRING_DATA = [];

    /**
     * Set columns list of integers values.
     *
     * @cont array
     */
    const INTEGER_DATA = [];

    /**
     * Set columns list of float values.
     *
     * @cont array
     */
    const FLOAT_DATA = [];

    /**
     * Set columns of booleans data type.
     *
     * @cont array
     */
    const BOOLEAN_DATA = [];

    /**
     * Localized data
     *
     * @const array
     */
    const LOCALIZED_DATA = [];

    /**
     * Auto save uploads in this list
     *
     * If it's an indexed array, in that case the request key will be as database column name
     * If it's associated array, the key will be request key and the value will be the database column name
     *
     * It can be passed as well as an array of options, current options schema:
     * [
     *    'key' => 'string', // the key that will be read from the request files, if not present, it will be same as $column key
     *    'column' => 'string', // if not present, it will be same as $key key
     *    'clearable' => 'bool', // if set to true, the column value will be set to empty if there is no file to be uploaded
     *    'arrayable' => 'bool', // if set to true, it will be stored as an array, if set to null it auto determined
     * ]
     *
     * @const array
     */
    const UPLOADS = [];

    /**
     * Geo Location data
     *
     * @const array
     */
    const LOCATION_DATA = [];

    /**
     * Set columns list of date values.
     *
     * @cont array
     */
    const DATE_DATA = [];

    /**
     * Set the columns will be filled with single record of collection data
     * i.e [country => CountryModel::class]
     *
     * @const array
     */
    const DOCUMENT_DATA = [];

    /**
     * Set the columns will be filled with array of records.
     * i.e [tags => TagModel::class]
     *
     * @const array
     */
    const MULTI_DOCUMENTS_DATA = [];

    /**
     * Auto fill the following columns as arrays directly from the request
     * It will encoded and stored as `JSON` format,
     * it will be also auto decoded on any database retrieval either from `list` or `get` methods
     *
     * @const array
     */
    const ARRAYBLE_DATA = ['permissions'];

    /**
     * Update the column if and only if its value is passed in the request, if set to true,
     * then all columns that is not in the request data will be not updated in the model and kept untouched.
     *
     * @const array
     */
    const WHEN_AVAILABLE_DATA = ['name', 'permissions'];

    /**
     * Only the columns added in this array will be affected by PATCH request if they were sent.
     * Note: patch handler should be activated in config/mongez.php admin.patchable
     *
     * @const array
     */
    const PATCHABLE_DATA = [];

    /**
     * Determine wether to use pagination in the `list` method
     * if set null, it will depend on pagination configurations
     *
     * @const bool
     */
    const PAGINATE = null;

    /**
     * Number of items per page in pagination
     * If set to null, then it will taken from pagination configurations
     *
     * @const int|null
     */
    const ITEMS_PER_PAGE = null;

    /**
     * Set all filter class you will use in this module
     *
     * @const array
     */
    const FILTERS = [
        UsersGroupsFilter::class,
    ];

    /**
     * Filter by columns used with `list` method only
     *
     * @const array
     */
    const FILTER_BY = [
        // inInt search
        'inInt' => ['id'],
        // bool search
        'bool' => ['published'],
    ];

    /**
     * Do any extra filtration here
     *
     * @return  void
     */
    protected function filter()
    {
    }

    /**
     * Set any extra data or columns that need more customizations
     * Please note this method is triggered on create or update call
     *
     * @param   mixed $model
     * @param   \Illuminate\Http\Request $request
     * @return  void
     */
    protected function setData($model, $request)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function onUpdate($model, $request, $oldModel)
    {
        $this->usersRepository->updateUserGroup($model);
    }
}
