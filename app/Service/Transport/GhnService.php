<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 11/22/23
 * Time: 1:14 PM
 */

namespace App\Service\Transport;

use Illuminate\Http\Request;

class GhnService
{

    public static function shippingOrder(Request $request, $data)
    {
        return GhnConnectApiService::shippingOrder($data);
    }

    public static function createOrder(Request $request, $data)
    {
        return GhnConnectApiService::createOrder($data);
    }
}