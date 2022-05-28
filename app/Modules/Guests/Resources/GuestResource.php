<?php

namespace App\Modules\Guests\Resources;

use HZ\Illuminate\Mongez\Resources\JsonResourceManager;

class GuestResource extends JsonResourceManager
{
    /**
     * Data that must be returned
     * This type of data is supposed to be generic
     * if the key is not found, a null will be returned.
     *
     * @const array
     */
    const DATA = [];

    /**
     * String Data
     * if the key is not found, an empty string '' will be returned.
     *
     * @const array
     */
    const STRING_DATA = ['deviceId', 'deviceType', 'ip', 'userAgent'];

    /**
     * Boolean Data
     * if the key is not found, a `false` value will be returned.
     *
     * @const array
     */
    const BOOLEAN_DATA = [];

    /**
     * Integer Data
     * if the key is not found, a `0` value will be returned.
     *
     * @const array
     */
    const INTEGER_DATA = ['id'];

    /**
     * Float Data
     * if the key is not found, a `0` value will be returned.
     *
     * @const array
     */
    const FLOAT_DATA = [];

    /**
     * Set that columns that will be formatted as dates
     * it could be numeric array or associated array to set the date format for certain columns
     *
     * if the key is not found, a null will be returned.
     *
     * @const array
     */
    const DATES = [];

    /**
     * Data that has multiple values based on locale codes
     * Mostly this is used with mongodb driver
     * If the locale-code header is present in the request headers
     * then it will return the value based on the locale code
     * otherwise it will return the value itself instead
     *
     * if the key is not found, an empty string '' will be returned.
     *
     * @const array
     */
    const LOCALIZED = [];

    /**
     * List of assets that will have a full url if available
     *
     * if the key is not found, an empty string '' will be returned.
     * @const array
     */
    const ASSETS = [];

    /**
     * Data that will be returned as a resources
     *
     * i.e [city => CityResource::class],
     * @const array
     */
    const RESOURCES = [];

    /**
     * Data that will be returned as a collection of resources
     *
     * i.e [cities => CityResource::class],
     * @const array
     */
    const COLLECTABLE = [];

    /**
     * Object Data
     * if the key is not found, a `{}` value will be returned.
     *
     * @const array
     */
    const OBJECT_DATA = [];

    /**
     * Data that should be returned if exists
     * If the key is set in this list and it doesn't exist in the resource
     * then it will not be sent to response
     *
     * @const array
     */
    const WHEN_AVAILABLE = [];
}
