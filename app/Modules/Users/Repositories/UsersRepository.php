<?php

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Modules\Users\Models\UsersGroup;

use App\Modules\Users\Filters\UsersFilter;
use App\Modules\Users\Resources\UserResource;
use HZ\Illuminate\Mongez\Repository\RepositoryInterface;
use HZ\Illuminate\Mongez\Repository\MongoDBRepositoryManager;

class UsersRepository extends MongoDBRepositoryManager implements RepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    const NAME = 'users';

    /**
     * {@inheritDoc}
     */
    const MODEL = User::class;

    /**
     * {@inheritDoc}
     */
    const RESOURCE = UserResource::class;

    /**
     * {@inheritDoc}
     */
    const DATA = ['password'];

    /**
     * Set columns list of string values.
     *
     * @const array
     */
    const STRING_DATA = ['name', 'email', 'phoneNumber'];

    /**
     * Set columns of booleans data type.
     *
     * @const array
     */
    const BOOLEAN_DATA = ['published'];

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
     * Add the column if and only if the value is passed in the request.
     *
     * @cont array
     */
    const WHEN_AVAILABLE_DATA = [
        'name', 'email', 'password', 'phoneNumber', 'published', 'group',
    ];

    /**
     * Store the list here as array
     *
     * @const array
     */
    const ARRAYBLE_DATA = [];

    /**
     * Set all filter class you will use in this module
     *
     * @const array
     */
    const FILTERS = [
        UsersFilter::class,
    ];

    /**
     * {@inheritDoc}
     */
    const FILTER_BY = [
        'int' => ['id'],
    ];

    /**
     * {@inheritDoc}
     */
    public $deleteDependenceTables = [];

    /**
     * Set the columns will be filled with single record of collection data
     * i.e [country => CountryModel::class]
     *
     * @const array
     */
    const DOCUMENT_DATA = [
        'group' => UsersGroup::class,
    ];

    /**
     * {@inheritDoc}
     */
    protected function setData($model, $request)
    {
        // add additional data
    }

    /**
     * {@inheritDoc}
     */
    public function onCreate($user, $request)
    {
    }

    /**
     * Update all users that matches the given group
     *
     * @param  Group $usersGroup
     * @return void
     */
    public function updateUserGroup(UsersGroup $usersGroup)
    {
        User::where('group.id', $usersGroup->id)->update([
            'group' => $usersGroup->sharedInfo(),
        ]);

        // check if current user is in the same group, then update its group as well
        $user = user();

        if (isset($user->group['id']) && $user->group['id'] == $usersGroup->id) {
            $user->group = $usersGroup->sharedInfo();
        }
    }

    /**
     * user login and generate token.
     *
     * @param array $data
     * @return Model|null
     */
    public function findForLogin(array $data): ?User
    {
        $user = $this->getByModel('email', $data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }

        return $user;
    }
}
