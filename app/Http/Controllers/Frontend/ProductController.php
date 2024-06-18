<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductWholesalePrice;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where([
            'status' => Product::STATUS_SUCCESS,
        ]);

        if ($key = $request->k) {
            $products->where('name', 'like', '%'.$key.'%');
        }
        if ($s = $request->s) {
            $products->where('supplier_id', $s);
        }

        if ($priceKey = $request->price) {
            if ($priceKey == 1) $products->where('price','<=', 2000000);
            if ($priceKey != 1) {
                $products->whereBetween('price',[1000000 * $priceKey, 1000000 * ($priceKey + 1)]);
            }
        }

        if ($request->sort) {
            $sort = explode(',', $request->sort);
            $column = $sort[0] ?? "id";
            $sortBy = $sort[1] ?? "desc";

            $products->orderBy($column, $sortBy);
        }
        $products = $products->paginate(9);

        $suppliers = Supplier::all();

        $prices = [
            [
                'name'  => '<= 2tr',
                'value' => 1
            ],
            [
                'name'  => '2 đến 3 triệu',
                'value' => 2
            ],
            [
                'name'  => '3 đến 4 triệu',
                'value' => 3
            ],
            [
                'name'  => '4 đến 5 triệu',
                'value' => 4
            ]
        ];


        $viewData = [
            'products'  => $products,
            'suppliers' => $suppliers,
            'query'     => $request->query(),
            'prices'    => $prices
        ];

        if (config('app.layout_admin') == 'v1') {
            return view('frontend.product.index', $viewData);
        }

        return view('frontend.v2.product.index', $viewData);
    }

    public function productWholesale(Request $request)
    {
        $user = Auth::user();

        $products = Product::with('wholesale')->where([
            'status'       => Product::STATUS_SUCCESS,
            'is_wholesale' => true
        ]);

        if ($key = $request->k) {
            $products->where('name', 'like', '%'.$key.'%');
        }


        $products = $products->orderByDesc('id')
            ->paginate(12);

        $viewData = [
            'products' => $products,
            'query'    => $request->query(),
            'user'     => $user
        ];

        return view('frontend.wholesale.index', $viewData);
    }
}
