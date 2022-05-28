<?php

namespace App\Modules\Users\Events;

class ResponseEvent
{
    /**
     * @param  array
     * @return array
     */
    public function wrapResponse(array $data): array
    {
        return ['data' => $data];
    }
}
