<?php

namespace App\Modules\Users\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Modules\Users\Traits\TokenGenerator;
use App\Modules\Users\Contracts\AccountInterface;
use App\Modules\Users\Traits\Auth\UpdatePassword;
use App\Modules\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use HZ\Illuminate\Mongez\Database\Eloquent\MongoDB\Model;

class User extends Model implements AccountInterface
{
    /**
     * use Sanctum Tokens
     */
    use HasApiTokens, TokenGenerator, HasFactory;

    /**
     * Update Password Trait
     */
    use UpdatePassword;

    /**
     * Shared info of the model
     * This is used for storing only important fields into another model
     *
     * @const array
     */
    const SHARED_INFO = ['id'];

    /**
     * Define list of other models that will be affected
     * as the current model is sub-document to it when it gets updated
     *
     * @example ModelClass::class => columnName will be converted to ['columnName.id', 'columnName', 'sharedInfo']
     * @example ModelClass::class => [searchingColumn, updatingColumn]
     * @example ModelClass::class => [searchingColumn, updatingColumn, sharedInfoMethod]
     *
     * @const array
     */
    const ON_MODEL_UPDATE = [];

    /**
     * Define list of other models that will be affected as the current object is part of array
     * as the current model is sub-document to it when it gets updated
     *
     * @example ModelClass::class => columnName will be converted to ['columnName.id', 'columnName', 'sharedInfo']
     * @example ModelClass::class => [searchingColumn, updatingColumn]
     * @example ModelClass::class => [searchingColumn, updatingColumn, sharedInfoMethod]
     *
     * @const array
     */
    const ON_MODEL_UPDATE_ARRAY = [];

    /**
     * Define list of other models that will clear the column from its records
     * A 1-1 relation
     *
     * Do not add the id, it will be appended automatically
     *
     * @example ModelClass::class => searchingColumn: string
     *
     * @const array
     */
    const ON_MODEL_DELETE_UNSET = [];

    /**
     * Define list of the models that have the current model as embedded document and pull it from the array
     *  A 1-n relation
     * Do not add the id, it will be appended automatically
     *
     * @example ModelClass::class => searchingColumn: string
     *
     * @const array
     */
    const ON_MODEL_DELETE_PULL = [];

    /**
     * Define list of other models that will be deleted
     * when this model is deleted
     * For example when a city is deleted, all related regions shall be deleted as well
     *
     * Do not add the id, it will be appended automatically
     *
     * @example Region::class => 'city'
     * @example ModelClass::class => searchingColumn: string
     *
     * @const array
     */
    const ON_MODEL_DELETE = [];

    /**
     * Get user account type
     *
     * @return string
     */
    public function accountType(): string
    {
        return 'user';
    }

    /**
     * Get customer id.
     *
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->id;
    }

    /**
     * Get shared info for the user that will be stored as a sub document of another collection
     *
     * @return array
     */
    public function sharedInfo(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    /**
     * Define user factory class.
     *
     * @return UserFactory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * Method sharedWithAccountType
     *
     * @return array
     */
    public function sharedWithAccountType(): array
    {
        return $this->only(['id', 'name', 'email', 'image']);
    }
}
