<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Service\Transport\GhnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function district(Request $request)
    {
        $districts = District::whereRaw(1);
        if ($request->province_id)
            $districts->where('province_id', $request->province_id);

        $districts = $districts->get();
        if ($request->ajax()) {
            return response()->json($districts);
        }

        return  $districts;
    }

    public function ward(Request $request)
    {
        $wards = Ward::whereRaw(1);
        if ($request->district_id)
            $wards->where('district_id', $request->district_id);

        $wards = $wards->get();
        if ($request->ajax()) {
            return response()->json($wards);
        }

        return  $wards;
    }

    public function shippingOrder(Request $request)
    {
        $province_id = $request->province_id;
        $district_id = $request->district_id;
        $ward_id = $request->ward_id;

        $province = Province::where("id", $province_id)->first();
        $district = District::find($district_id);
        $ward = Ward::find($ward_id);

        $ghnDistrict = json_decode($district->ghn, true);
        $ghnWard = json_decode($ward->ghn, true);
        $responseGhn = GhnService::shippingOrder($request, [
            "from_district_id"  => null,
            "service_id"        => 53320,
            "service_type_id"   => null,
            "to_district_id"    => $ghnDistrict["ghn_district_id"] ?? null,
            "to_ward_code"      => $ghnWard['ghn_code'] ?? null,
            "height"            => 1,
            "length"            => 1,
            "weight"            => 1,
            "width"             => 1,
            "cod_failed_amount" => 0,
            "insurance_value"   => 0, // giá trị đơn hàng
            "coupon"            => null
        ]);
        $totalOrder = str_replace(',','',\Cart::subtotal(0));
        $data = [
            'totalOrder' => $totalOrder,
            'ghn' => 0
        ];
        if (isset($responseGhn->code) && $responseGhn->code === 200)
        {
            $data['ghn'] = $responseGhn->data;
            return response()->json($data);
        }
        return response()->json($data);
    }
}
