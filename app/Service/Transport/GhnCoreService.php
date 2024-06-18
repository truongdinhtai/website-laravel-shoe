<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 5/17/23 .
 * Time: 2:44 PM .
 */

namespace App\Service\Transport;

use App\Services\NetworkService;
use GuzzleHttp\Client;

class GhnCoreService
{
    public static function getClient()
    {
        return new Client([
            "base_uri" => env('GHN_URL'),
            "headers"  => [
                'Token'  => env('GHN_TOKEN_API'),
                'Accept' => 'application/json',
            ]
        ]);
    }
}
