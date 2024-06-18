<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\Order\JobCreateOrderToGhn;
use App\Jobs\Order\JobSendEmailCreateOrder;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductValue;
use App\Models\ProductWholesalePrice;
use App\Models\Province;
use App\Models\Transaction;
use App\Services\ShoppingCartService\PayManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paymentId) {
            \Cart::destroy();
            \Session::flash('toastr', [
                'type'    => 'success',
                'message' => 'Thanh toán thành công'
            ]);
            return redirect()->route('get.home');
        }

        if (\Cart::count() == 0) {
            toastr()->error('Không có sản phẩm trong giỏ hàng!', 'Thông báo');
            return redirect()->route('get.home');
        }
        $provinces = Province::all();
        $shopping = \Cart::content();

        $viewData = [
            'title_page' => 'Danh sách giỏ hàng',
            'shopping'   => $shopping,
            'provinces'  => $provinces
        ];
        return view('frontend.shopping.index', $viewData);
    }

    public function updateAttribute(Request $request, $id)
    {
        $size = $request->size;
        //4. Update
        \Cart::update($id, [
            'options' => [
                'size' => $size,
            ]
        ]);

        return response([
            'messages' => 'Cập nhật thành công',
        ]);
    }

    /**
     * Thêm giỏ hàng
     * */
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        $qty = $request->qty ?? 1;
        //1. Kiểm tra tồn tại sản phẩm
        if (!$product) {
            return redirect()->to('/');
        }

        // 2. Kiểm tra số lượng sản phẩm
        if ($product->number < 1) {
            //4. Thông báo
            toastr()->error('Số lượng sản phẩm không đủ!', 'Thông báo');

            return redirect()->back();
        }


        $cart = \Cart::content();
        $idCartProduct = $cart->search(function ($cartItem) use ($product) {
            if ($cartItem->id == $product->id) {
                return $cartItem->id;
            }
        });

        //  Check các thuộc tính
        if ($idCartProduct) {
            $productByCart = \Cart::get($idCartProduct);
            if ($product->number < ($productByCart->qty + $qty)) {
                toastr()->warning('Số lượng không đủ!', 'Thông báo');
                return redirect()->back();
            }
        }

        // lấy thông tin thuộc tính
        $requestAll = $request->all();
        $attributes = [];
        foreach ($requestAll as $key => $attr) {
            if (strpos($key, "attr") !== false) {
                $attributes[] = ProductValue::with('productOption')->where('id', $attr)->first()->toArray() ?? [];
            }
        }
        if (empty($attributes)) {
            toastr()->warning('Bạn chưa chọn thuộc tính sản phẩm!', 'Thông báo');
            return redirect()->back();
        }

        // 3. Thêm sản phẩm vào giỏ hàng
        \Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $qty,
            'price'   => $product->price,
            'weight'  => '1',
            'options' => [
                'sale'       => 0,
                'price_old'  => $product->price,
                'image'      => $product->avatar,
                'attributes' => $attributes ?? []
            ]
        ]);

        //4. Thông báo
        toastr()->success('Thêm giỏ hàng thành công!', 'Thông báo');

        return redirect()->back();
    }

    public function postPay(Request $request)
    {
        $data = $request->except("_token");
        try {
            DB::beginTransaction();
            $shopping = \Cart::content();
            $order = Order::create([
                'user_id'              => \Auth::user()->id ?? 0,
                'discount'             => 0,
                'total_discount'       => 0,
                'total_shipping_order' => $request->total_shipping_order ?? 0,
                'total_price'          => 0,
                'payment_type'         => $request->payment_type ?? 1,
                'order_type'           => Order::ORDER_TYPE_DEFAULT,
                'status'               => 1,
                'province_id'          => $request->province_id ?? 0,
                'district_id'          => $request->district_id ?? 0,
                'ward_id'              => $request->ward_id ?? 0,
                'node'                 => $request->note,
                'receiver_name'        => $request->receiver_name ?? null,
                'receiver_email'       => $request->receiver_email ?? null,
                'receiver_phone'       => $request->receiver_phone ?? null,
                'receiver_address'     => $request->receiver_address ?? null,
                'created_at'           => Carbon::now()
            ]);

            if ($order) {
                $total = 0;
                foreach ($shopping as $item) {
                    $transaction = new Transaction();
                    $transaction->order_id = $order->id;
                    $transaction->product_id = $item->id;
                    $transaction->price = $item->price;
                    $transaction->quantity = $item->qty;
                    $transaction->discount = 0;
                    $transaction->name = $item->name;
                    $transaction->avatar = $item->options->image;
                    $transaction->status = $order->status;
                    $transaction->created_at = Carbon::now();
                    $transaction->save();
                    $total += $item->price * $item->qty;

                    $this->incrementProduct($item->id);
                }
                $order->total_price = $total;
                $order->updated_at = Carbon::now();
                $order->save();
            }

            DB::commit();
//            dispatch(new JobCreateOrderToGhn($order));
            dispatch(new JobSendEmailCreateOrder($order));
            if ($request->payment_type == Order::PAYMENT_TYPE_ONLINE) {
                $this->callPaymentOnline($order);
            }
//            $this->payMomo();
            toastr()->success('Đơn hàng đã được tạo thành công!', 'Thông báo');
            \Cart::destroy();
            return redirect()->to('/');
        } catch (\Exception $exception) {
            DB::rollBack();
            toastr()->error('Tạo đơn hàng thất bại!', 'Thông báo');
            Log::error("-------------- E: " . json_encode($exception->getMessage()));
        }

        return redirect()->back();
    }

    private function callPaymentOnline($order)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array (
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => 'https://123code.net/api/v1/payment/add',
            CURLOPT_USERAGENT      => 'BANHANG',
            CURLOPT_POST           => 1,
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_POSTFIELDS     => http_build_query(array (
                'order_id'     => $order->id,
                'service_code' => 'QUANAO',
                'url_return'   => route('get.callback.payment_online', ['id' => $order->id]),
                'amount'       => $order->total_price
            ))
        ));
        $resp = curl_exec($curl);
        $resp = json_decode($resp);
        if (isset($resp->link)) {
            header('Location: ' . $resp->link);
            die();
        }
        \Cart::destroy();
        curl_close($curl);
        die;
    }

    public function update(Request $request, $id)
    {
        //1.Lấy tham số
        $qty = $request->qty ?? 1;
        //4. Update
        \Cart::update($id, $qty);
        toastr()->success('Cập nhật số lượng thành công', 'Thông báo!');
        return redirect()->back();
    }

    public function payOnline(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        if ($request->vnp_TransactionStatus == "00") {
            $order->status = Order::STATUS_PAID;
            $order->save();
            \Cart::destroy();
            return redirect()->route('get.alert_payment', ['alert' => 'success']);
        }
        return redirect()->route('get.alert_payment', ['alert' => 'fail']);
    }

    public function paymentSuccess(Request $request)
    {
        $data = $request->all();
        return view('frontend.shopping.alert', compact('data'));
    }

    /**
     *  Xoá sản phẩm đơn hang
     * */
    public function delete(Request $request, $rowId)
    {
        \Cart::remove($rowId);
        toastr()->success('Xoá sản phẩm khỏi đơn hàng thành công', 'Thông báo!');
        return redirect()->back();
    }

    public function incrementProduct($productID)
    {
        Product::find($productID)->increment('count_buy');
    }

    public function postOrderWholesale(Request $request, $productID)
    {
        $product = Product::find($productID);
        if (!$product) {
            toastr()->error("Không tồn tại sản phẩm", "Thông báo");
            return redirect()->back();
        }

        $qty = $request->qty ?? 0;

        $wholesale = ProductWholesalePrice::where('product_id', $productID)->get();
        if (!$wholesale || $wholesale->IsEmpty()) {
            toastr()->error("Sản phẩm chưa set giá sỉ", "Thông báo");
            return redirect()->back();
        }

        $price = 0;
        foreach ($wholesale as $item) {
            if ($item->form <= $qty && $item->to > $qty) {
                $price = $item->price;
                break;
            }
        }

        if ($price) {
            $order = Order::create([
                'user_id'          => \Auth::user()->id ?? 0,
                'discount'         => 0,
                'total_discount'   => 0,
                'total_price'      => $price * $qty,
                'status'           => 1,
                'order_type'       => Order::ORDER_TYPE_WHOLESALE,
                'node'             => $request->note,
                'receiver_name'    => \Auth::user()->name ?? null,
                'receiver_email'   => \Auth::user()->email ?? null,
                'receiver_phone'   => \Auth::user()->phone ?? null,
                'receiver_address' => \Auth::user()->address ?? null,
                'created_at'       => Carbon::now()
            ]);

            if ($order) {
                $transaction = new Transaction();
                $transaction->order_id = $order->id;
                $transaction->product_id = $productID;
                $transaction->price = $price;
                $transaction->quantity = $qty;
                $transaction->discount = 0;
                $transaction->name = $product->name;
                $transaction->avatar = $product->avatar;
                $transaction->status = $order->status;
                $transaction->created_at = Carbon::now();
                $transaction->save();
                $this->incrementProduct($productID);
            }
        }
        toastr()->success('Tạo đơn sỉ thành công!', 'Thông báo');
        return redirect()->back();
    }

    public function payMomo()
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo_ATM";
        $amount = 10000;
        $orderId = time() ."";
        $redirectUrl = route('get.alert_payment', ['alert' => 'success']);
//        $redirectUrl = "http://localhost:8080/shoptrangsuc/index.php";
//        $ipnUrl = "http://localhost:8080/shoptrangsuc/index.php";
        $ipnUrl = route('get.alert_payment', ['alert' => 'success']);
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        $extraData = "";
//        $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
                      'partnerName' => "Test",
                      "storeId" => "MomoTestStore",
                      'requestId' => $requestId,
                      'amount' => $amount,
                      'orderId' => $orderId,
                      'orderInfo' => $orderInfo,
                      'redirectUrl' => $redirectUrl,
                      'ipnUrl' => $ipnUrl,
                      'lang' => 'vi',
                      'extraData' => $extraData,
                      'requestType' => $requestType,
                      'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there

        header('Location: ' . $jsonResult['payUrl']);
        die;
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
