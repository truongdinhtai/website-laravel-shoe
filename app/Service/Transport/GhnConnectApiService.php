<?php


namespace App\Service\Transport;

use Illuminate\Support\Facades\Log;

class GhnConnectApiService
{
    public static function shippingOrder($data)
    {
        try {
            Log::info("=============== DATA SEND SHIPPING ORDER: ". json_encode($data));
            $response = GhnCoreService::getClient()->request('POST', "shiip/public-api/v2/shipping-order/fee", [
                'json' => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $exception) {
            Log::error("-------------- " . json_encode($exception->getMessage()));
            return [];
        }
    }

    public static function createOrder($data)
    {
        try {
            Log::info("=============== DATA CREATE ORDER: ". json_encode($data));
            $response = GhnCoreService::getClient()->request('POST', "shiip/public-api/v2/shipping-order/create", [
                'json' => $data
            ]);
            return json_decode($response->getBody());
        } catch (\Exception $exception) {
            Log::error("-------------- " . json_encode($exception->getMessage()));
            return [];
        }
    }
}