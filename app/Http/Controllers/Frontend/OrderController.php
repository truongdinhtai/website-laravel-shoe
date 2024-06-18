<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user:id,name')->whereRaw(1);
        $user = Auth::user();
        if (!$user) {
            return redirect()->to('/');
        }

        $orders->where('user_id', $user->id);

        $orders = $orders->orderByDesc('id')->paginate(20);

        $viewData = [
            'orders' => $orders
        ];

        return view('frontend.order.index', $viewData);
    }

    public function detail(Request $request, $id)
    {
        $order        = Order::with('user')->find($id);
        $transactions = Transaction::where('order_id', $id)->get();
        $viewData = [
            'order'        => $order,
            'transactions' => $transactions,
        ];

        return view('frontend.order.detail', $viewData);
    }

    public function updateStatus(Request $request, $id)
    {
        $order        = Order::with('user')->find($id);
        if (!$order) return abort(404);

        $status = (int)$request->status;
        $order->status = $status;
        $order->save();
        Transaction::where('order_id', $id)->update([
            'status' => $status
        ]);
        toastr()->success('Cập nhật trạng thái thành công!', 'Thông báo!');
        return redirect()->route('get.order');
    }
}
