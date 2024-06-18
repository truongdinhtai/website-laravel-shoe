<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductValue;
use App\Models\Rating;
use App\Models\Vote;
use App\Search\ProductSimilarity;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProductDetailController extends Controller
{
    public function index(Request $request, $id, $slug)
    {
        $product = Product::with('images', 'wholesale', 'category')->findOrFail($id);
        $categories = Category::orderByDesc('id')->get();
        $user = Auth::user();
        $productOption = ProductValue::with('productOption')
            ->where('product_id', $id)
            ->orderBy('product_option_id')
            ->get();

        $attributes = [];
        foreach ($productOption as $item) {
            $attributes[$item->productOption->option_name ?? ""][] = $item->toArray();
        }

        $ratingsDashboard = Vote::groupBy('number_vote')
            ->where('product_id', $product->id)
            ->select(\DB::raw('count(number_vote) as count_number'), \DB::raw('sum(number_vote) as total'))
            ->addSelect('number_vote')
            ->get()->toArray();

        $ratingDefault = $this->mapRatingDefault();

        foreach ($ratingsDashboard as $key => $item) {
            $ratingDefault[$item['number_vote']] = $item;
        }

        $productsSuggest = Product::where('status', Product::STATUS_SUCCESS)
            ->where('category_id', $product->category_id)
            ->orderByDesc('id')
            ->get();

        $productValues = ProductValue::with('productOption')->where('product_id', $id)->get();
        $ratings = Vote::with('user:id,name,avatar')->where('product_id', $product->id)->paginate(20);


        $products = $productsSuggest->toArray();
        $selectedId = $product->id;

        

        $query = $request->all();
        $query['id'] = $product->id;
        $query["qty"] = $request->qty ?? 1;

        $viewData = [
            'product'         => $product,
            'productsSuggest' => $productsSuggest,
            'query'           => $query,
            'categories'      => $categories,
            'user'            => $user,
            'attributes'      => $attributes,
            'ratingDefault'   => $ratingDefault,
            'ratings'         => $ratings,
            'productValues'   => $productValues
        ];

        if (config('app.layout_admin') == 'v1') {
            return view('frontend.product_detail.index', $viewData);
        }

        $productsSuggest = Product::with('category')->where('status', Product::STATUS_SUCCESS)
            ->where('category_id', $product->category_id)
            ->orderByDesc('id')
            ->limit(10)
            ->get();

        $viewData['productsSuggest'] = $productsSuggest;

        return view('frontend.v2.product_detail.index', $viewData);
    }

    private function mapRatingDefault()
    {
        $ratingDefault = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDefault[$i] = [
                "count_number" => 0,
                "total"        => 0,
                "number_vote"  => 0
            ];
        }
        return $ratingDefault;
    }
}
