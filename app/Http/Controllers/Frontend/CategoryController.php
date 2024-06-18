<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return abort(404);
        }

        $products = Product::where('category_id', $category->id);

        if ($s = $request->s) {
            $products->where('supplier_id', $s);
        }

        if ($priceKey = $request->price) {
            if ($priceKey == 1) $products->where('price','<=', 1000000);
            if ($priceKey != 1) {
                $products->whereBetween('price',[1000000 * $priceKey, 1000000 * ($priceKey + 1)]);
            }
        }

        $products = $products->orderByDesc('id')
        ->paginate(12);

        $suppliers = Supplier::all();
        $prices = [
            [
                'name' => '<= 1tr',
                'value' => 1
            ],
            [
                'name' => '1 đến 2 triệu',
                'value' => 2
            ],
            [
                'name' => '2 đến 3 triệu',
                'value' => 3
            ],
            [
                'name' => '3 đến 4 triệu',
                'value' => 4
            ],
            [
                'name' => '4 đến 5 triệu',
                'value' => 5
            ],
            [
                'name' => '5 đến 6 triệu',
                'value' => 6
            ],
        ];

        $viewData = [
            'products'  => $products,
            'category'  => $category,
            'suppliers' => $suppliers,
            'prices' => $prices,
            'query'     => $request->query()
        ];

        if (config('app.layout_admin') == 'v1') {
            return view('frontend.category.index', $viewData);
        }

        return view('frontend.v2.category.index', $viewData);
    }
}
