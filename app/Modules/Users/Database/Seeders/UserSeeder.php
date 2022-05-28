<?php

namespace App\Modules\Users\Database\Seeders;

use HZ\Illuminate\Mongez\Database\Seeders\SeederManager;

class UserSeeder extends SeederManager
{
    /**
     * Repository name
     *
     * @var string
     */
    protected const REPOSITORY_NAME = 'users';

    /**
     * Total of records will be generated
     *
     * @var int
     */
    protected const TOTAL_RECORDS = 1;

    /**
     * name of seeds you need to generated with DOCUMENT_DATA from repository
     * [columnName => demoSeeder::class]
     * column Name must be the same name in the DOCUMENT_DATA
     *
     * @var array
     */
    protected const DOCUMENT_SEEDER = [];

    /**
     * name of seeds you need to generated with MULTI_DOCUMENT_DATA from repository
     * [columnName => demoSeeder::class]
     * column Name must be the same name in the MULTI_DOCUMENT_DATA
     *
     * @var array
     */
    protected const MULTI_DOCUMENT_SEEDER = [];

    /**
     * localization keys
     *
     * @var array
     */
    protected const LOCALIZED_DATA = [];

    /**
     * {@inheritDoc}
     */
    public function setData()
    {
        $columns = ['name','email', 'password', 'phoneNumber'];

        foreach ($columns as $column) {
            switch ($column) {
                case 'name':
                    $this->data->{$column} = 'admin';

                    break;
                case 'email':
                    $this->data->{$column} = 'hassanzohdy@gmail.com';

                    break;
                case 'password':
                    $this->data->{$column} = '123123123';

                    break;
                case 'phoneNumber':
                    $this->data->{$column} = $this->faker->e164PhoneNumber();
            }
        }
    }
}
