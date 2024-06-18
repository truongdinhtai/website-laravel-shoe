<?php

namespace App\Http\Controllers\Backend;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::with('userType')->orderByDesc('id')
            ->limit(10)
            ->get();

        $products = Product::with('category:id,name', 'user:id,name')
            ->withCount('images')
            ->limit(10)
            ->orderByDesc('id')
            ->get();

        $listDay = Date::getListDayInMonth();

        //Doanh thu theo tháng ứng với trạng thái đã xử lý
        $revenueTransactionMonth = Order::where('status', Order::STATUS_PAID)
            ->whereMonth('created_at', date('m'))
            ->select(\DB::raw('sum(total_price) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        $revenueTransactionMonthDefault = Order::where('status', Order::STATUS_DEFAULT)
            ->whereMonth('created_at', date('m'))
            ->select(\DB::raw('sum(total_price) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();


        $arrRevenueTransactionMonthDefault = [];
        foreach ($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonth as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }

            $arrRevenueTransactionMonth[] = (int)$total;

            $total = 0;
            foreach ($revenueTransactionMonthDefault as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthDefault[] = (int)$total;
        }

        $dashboardStatusOrder = Order::select(\DB::raw('sum(total_price) as totalMoney'), 'status')
            ->groupBy('status')
            ->get()->toArray();

        $statusOrder = (new Order())->getStatus();
        foreach ($statusOrder as $item) {
            $totalMoney = 0;
            foreach ($dashboardStatusOrder as $orderStatus) {
                if ($orderStatus['status'] == $item['status']) {
                    $totalMoney = $orderStatus['totalMoney'];
                    break;
                }
            }
            $statusTransaction[] = [
                $item['name'],
                (int)$totalMoney,
                false
            ];
        }

        $viewData = [
            'users'                             => $users,
            'products'                          => $products,
            'listDay'                           => json_encode($listDay),
            'statusTransaction'                 => json_encode($statusTransaction),
            'arrRevenueTransactionMonth'        => json_encode($arrRevenueTransactionMonth),
            'arrRevenueTransactionMonthDefault' => json_encode($arrRevenueTransactionMonthDefault)
        ];

        return view('backend.home.index', $viewData);
    }

    public function loadDataDashboard(Request $request)
    {
        try {
            $totalUser = User::count();
            $totalProduct = Product::count();
            $totalTransaction = Transaction::count();
            $totalOrder = Order::count();
            $totalUserNew = User::whereDate('created_at', Carbon::today())->count();

            // Doanh thu ngày
            $totalMoneyDay = Order::whereDay('created_at', date('d'))
                ->where('status', Order::STATUS_PAID)
                ->sum('total_price');

            // Tuần
            $totalMoneyWeed = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where('status', Order::STATUS_PAID)
                ->sum('total_price');

            // doanh thu thag
            $totalMoneyMonth = Order::whereMonth('created_at', date('m'))
                ->where('status', Order::STATUS_PAID)
                ->sum('total_price');

            // doanh thu nam
            $totalMoneyYear = Order::whereYear('created_at', date('Y'))
                ->where('status', Order::STATUS_PAID)
                ->sum('total_price');

            return response()->json([
                'totalUser'        => $totalUser,
                'totalProduct'     => $totalProduct,
                'totalTransaction' => $totalTransaction,
                'totalUserNew'     => $totalUserNew,
                'totalOrder'       => $totalOrder,
                'totalMoneyDay'    => number_format($totalMoneyDay,0,',','.') . ' đ',
                'totalMoneyMonth'  => number_format($totalMoneyMonth,0,',','.') . ' đ',
                'totalMoneyYear'   => number_format($totalMoneyYear,0,',','.') . ' đ',
                'totalMoneyWeed'   => number_format($totalMoneyWeed,0,',','.') . ' đ',
            ]);

        } catch ( \Exception $exception ) {

        }
    }
}
