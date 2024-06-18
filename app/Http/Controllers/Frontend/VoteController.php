<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoteController extends Controller
{
    public function create(Request $request, $transactionID, $productID)
    {
        $product = Product::find($productID);
        $transaction = Transaction::find($transactionID);
        return view('frontend.order.vote', compact('product', 'transaction'));
    }

    public function store(Request $request, $transactionID, $productID)
    {
        try{
            DB::beginTransaction();
            $data = $request->except('_token');
            $data['user_id'] = \Auth::user()->id ?? 0;
            $data['product_id']= $productID;
            $data['created_at'] = Carbon::now();
            Vote::create($data);


            $product = Product::find($productID);
            if ($product) {
                $product->total_vote += 1;
                $product->total_stars += $request->number_vote;
                $product->updated_at = Carbon::now();
                $product->save();
            }
            DB::commit();
            toastr()->success("Đánh giá sản phẩm $product->name thành công", 'Thông báo');
            return redirect()->route('get.order.detail', $transactionID);
        }catch (\Exception $exception) {
            toastr()->error("Đánh giá sản phẩm $product->name thất bại", 'Thông báo');
            Log::error("-------------- " . json_encode($exception->getMessage()));
            DB::rollBack();
            return redirect()->back();
        }
    }
}
