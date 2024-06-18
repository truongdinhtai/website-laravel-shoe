<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')->whereRaw(1);

        $orders = $orders->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'orders' => $orders
        ];

        return view('backend.order.index', $viewData);
    }

    public function delete(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                Transaction::where('order_id', $id)->delete();
                $order->delete();
            }

            toastr()->success("Xử lý dữ liệu thành công", "Thông báo!");
        } catch (\Exception $exception) {
            toastr()->error("Xử lý dữ liệu thất bại", "Thông báo!");
        }
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $order                = Order::find($id);
        $transactions         = Transaction::where('order_id', $id)->get();
        $model                = new Order();
        $status               = $model->getStatus();
        $statusShippingConfig = $model->getStatusShippingConfig();

        $viewData = [
            'order'                => $order,
            'transactions'         => $transactions,
            'status'               => $status,
            'statusShippingConfig' => $statusShippingConfig,
        ];

        return view('backend.order.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['updated_at'] = Carbon::now();

            Order::find($id)->update($data);

            Transaction::where('order_id', $id)->update([
                'status' => $request->status,
                'updated_at' => Carbon::now()
            ]);

            DB::commit();
            toastr()->success("Xử lý dữ liệu thành công", "Thông báo!");
        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error("ERROR => OrderController@update => " . $exception->getMessage());
            toastr()->error("Xử lý dữ liệu thất bại", "Thông báo!");
        }

        return redirect()->route('get_admin.order.index');
    }

    public function show(Request $request, $id)
    {
        $order        = Order::find($id);
        $transactions = Transaction::where('order_id', $id)->get();

        $viewData = [
            'order'        => $order,
            'transactions' => $transactions
        ];

        return view('backend.order.show', $viewData);
    }
}
