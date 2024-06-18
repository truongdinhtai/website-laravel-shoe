<?php

namespace App\Jobs\Order;

use App\Models\Order;
use App\Service\Transport\GhnService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class JobCreateOrderToGhn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order = Order::with('province', 'district', 'ward')->where("id", $this->order->id)->first();
        $template = self::templateCreateOrder();
        $template['from_name'] = "TrungPhuNA";
        $template['from_phone'] = "0986420994";
        $template['from_address'] = "97 - 99 Láng Hạ - Đống Đa - Hà Nội";
        $template['from_ward_name'] = "Tứ Hiệp";
        $template['from_district_name'] = "Thanh Trì";
        $template['from_province_name'] = "Hà Nội";
        $template['to_name'] = $order->receiver_name;
        $template['to_phone'] = $order->receiver_phone;
        $template['to_address'] = $order->province->name ?? "";
        $template['to_ward_name'] = $order->ward->name ?? "";
        $template['to_district_name'] = $order->district->name ?? "";
        $template['to_province_name'] = $order->province->name ?? "";
        $template['content'] = $order->note;
        $template['insurance_value'] = $order->total_price;
        $request = new Request();
        $responseGhn = GhnService::createOrder($request, $template);
        Log::info("=========== LOG CREATE ORDER: ". json_encode($responseGhn));
        if (isset($responseGhn->code) && $responseGhn->code === 200)
        {
            $data = $responseGhn->data;
            $order->order_referral_code = $data->order_code;
            $order->save();
        }
    }

    protected static function templateCreateOrder()
    {
        return [
            "payment_type_id"    => 2,
            "note"               => "Tintest 123",
            "required_note"      => "KHONGCHOXEMHANG",
            "return_phone"       => "0332190158",
            "return_address"     => "39 NTT",
            "return_district_id" => null,
            "return_ward_code"   => "",
            "client_order_code"  => "",
            "from_name"          => "",
            "from_phone"         => "",
            "from_address"       => "",
            "from_ward_name"     => "",
            "from_district_name" => "",
            "from_province_name" => "",
            "to_name"            => "",
            "to_phone"           => "",
            "to_address"         => "72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam",
            "to_ward_name"       => "Phường 14",
            "to_district_name"   => "Quận 10",
            "to_province_name"   => "HCM",
            "cod_amount"         => 0,
            "content"            => "",
            "weight"             => 1,
            "length"             => 1,
            "width"              => 1,
            "height"             => 1,
            "cod_failed_amount"  => 2000,
            "pick_station_id"    => null,
            "deliver_station_id" => null,
            "insurance_value"    => 0,
            "service_id"         => 53320,
            "service_type_id"    => null,
            "coupon"             => null,
            "pickup_time"        => null, // 1692840132
            "pick_shift"         => [
                2
            ],
            "items"              => [
                [
                    "name"     => "Áo Polo",
                    "code"     => "Polo123",
                    "quantity" => 1,
                    "price"    => 200000,
                    "length"   => 1,
                    "width"    => 1,
                    "weight"   => 1,
                    "height"   => 1,
                    "category" => [
                        "level1" => "Áo"
                    ]
                ]
            ]
        ];
    }
}
