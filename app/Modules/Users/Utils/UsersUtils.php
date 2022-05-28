<?php

namespace App\Modules\Users\Utils;

use App\Modules\Users\Providers\UsersServiceProvider;

class UsersUtils
{
    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    public static function trans($key = null, $replace = [], $locale = null)
    {
        static $baseTranslationName;

        if (! $baseTranslationName) {
            $baseTranslationName = UsersServiceProvider::TRANSLATION_PREFIX;
        }

        return trans($baseTranslationName . '::' . $key, $replace, $locale);
    }
}
