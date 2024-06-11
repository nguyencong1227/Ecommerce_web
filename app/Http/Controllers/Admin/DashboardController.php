<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Date;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user = Auth::user();

        if ($user->VaiTro == 2) {
            return redirect()->route('order.pack', 0);
        }

        if ($user->VaiTro == 3) {
            return redirect()->route('order.deliver', 1);
        }

        $numberProduct = Product::count();
        $numberUser = User::count();
        $numberContact = Contact::count();
        $numberSupplier = Supplier::count();

        $day = $request->select_day ? $request->select_day : date('d');
        $month = $request->select_month ? $request->select_month : date('m');
        $year = $request->select_year ? $request->select_year : date('Y');
        $listDay = Date::getListDayInMonth($month, $year);

        $totalMoneyDay = Order::whereIn('TrangThai', [0,1,2,3])->whereDay('NgayTao', $day)->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->sum('TongTien');
        $totalMoneyMonth = Order::whereIn('TrangThai', [0,1,2,3])->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->sum('TongTien');
        $totalMoneyYear = Order::whereIn('TrangThai', [0,1,2,3])->whereYear('NgayTao', $year)->sum('TongTien');
        $totalMoney = Order::whereIn('TrangThai', [0,1,2,3])->sum('TongTien');

        $orderSuccess = Order::where('TrangThai', 3);
        if($request->select_day) {
            $orderSuccess->whereDay('NgayTao', $day);
        }
        $orderSuccess =  $orderSuccess->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->count();

        $orderCanGiao = Order::where('TrangThai', 1);
        if($request->select_day) {
            $orderCanGiao->whereDay('NgayTao', $day);
        }
        $orderCanGiao =  $orderCanGiao->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->count();

        $orderDangGiao = Order::where('TrangThai', 2);
        if($request->select_day) {
            $orderDangGiao->whereDay('NgayTao', $day);
        }
        $orderDangGiao  = $orderDangGiao->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->count();

        $orderHuy = Order::where('TrangThai', 4);
        if($request->select_day) {
            $orderHuy->whereDay('NgayTao', $day);
        }
        $orderHuy =  $orderHuy->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->count();

        $orderKhongNhan = Order::where('TrangThai', 5);
        if($request->select_day) {
            $orderKhongNhan->whereDay('NgayTao', $day);
        }
        $orderKhongNhan = $orderKhongNhan->whereMonth('NgayTao',$month)->whereYear('NgayTao', $year)->count();

        $viewData = [
            'numberProduct' => $numberProduct,
            'orderSuccess' => $orderSuccess,
            'orderCanGiao' => $orderCanGiao,
            'orderDangGiao' => $orderDangGiao,
            'orderHuy' => $orderHuy,
            'orderKhongNhan' => $orderKhongNhan,
            'numberUser' => $numberUser,
            'numberContact' => $numberContact,
            'numberSupplier' => $numberSupplier,
            'listDay' => $listDay,
            'totalMoneyDay' => $totalMoneyDay,
            'totalMoneyMonth' => $totalMoneyMonth,
            'totalMoneyYear' => $totalMoneyYear,
            'totalMoney' => $totalMoney,

        ];
        return view('backend.dashboard.index', $viewData);
    }
}
