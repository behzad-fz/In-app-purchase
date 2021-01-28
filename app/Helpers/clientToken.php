<?php

use App\Services\ClientTokenService;

if (! function_exists('generateNewToken')) {
    /**
     *
     * @param int $id
     *
     * The id of the Device
     */
    function generateNewToken(int $id)
    {
        return resolve(ClientTokenService::class)->generateNewToken($id);
    }
}
