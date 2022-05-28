<?php

namespace App\Modules\Guests\Utils;

use App\Modules\Guests\Providers\GuestsServiceProvider;

class GuestsUtils
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
            $baseTranslationName = GuestsServiceProvider::TRANSLATION_PREFIX;
        }

        return trans($baseTranslationName . '::' . $key, $replace, $locale);
    }
}
