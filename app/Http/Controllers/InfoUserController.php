<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\InfoUserRequest;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;

class InfoUserController extends MenuController
{
    public function __construct()
    {
        $infor = self::getInforShop();
        view()->share([
            'infor' => $infor
        ]);
    }
    //
    public function index()
    {
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }
        $user = \Auth::guard('nd')->user();

        $menu_parent = self::getMenus();
        return view('frontend.update_user_info', compact('menu_parent', 'user'));
    }

    public function updateInfoUser(InfoUserRequest $request)
    {
        $data = [
            'Ten' => $request->name,
            'email' => $request->email,
            'SDT' => $request->phone_number,
            'DiaChi' => $request->address,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }

        $user = User::find(\Auth::guard('nd')->user()->id);
        try {
            $user->update($data);
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể cập nhật thông tin người dùng');
        }
    }

    public function listOrderTransported()
    {
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }
        $status = Order::STATUS_ORDER;
        $menu_parent = self::getMenus();
        $userId = \Auth::guard('nd')->user()->id;
        $orders = Order::with(['user'])->where('id_ND', $userId)->whereIn('TrangThai', [0, 1, 2])->orderByDesc('id')->paginate(12);

        return view('frontend.list_order_transported', compact('menu_parent', 'orders', 'status'));
    }

    public function listOrderSuccess()
    {
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }
        $status = Order::STATUS_ORDER;
        $menu_parent = self::getMenus();
        $userId = \Auth::guard('nd')->user()->id;
        $orders = Order::with(['user'])->where('id_ND', $userId)->whereIn('TrangThai', [3, 4, 5])->orderByDesc('id')->paginate(12);

        return view('frontend.list_order_success', compact('menu_parent', 'orders', 'status'));
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('list.order.transported')->with('danger', 'Đơn hàng không tồn tại !!');
        }
        $orderDetails = Order_Detail::where('id_DH', $id)->get();
        if (!$orderDetails->isEmpty()) {
            foreach ($orderDetails as $orderDet) {
                $product = Product::find($orderDet->id_SP);
                $product->update(['SoLuong' => $product->SoLuong + $orderDet->SoLuong]);
            }
        }
        try {
            $order->update(['TrangThai' => 4]);
            return redirect()->back()->with('success', 'Hủy đơn hàng thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể hủy đơn hàng');
        }
    }

    public function getFormChangePasswor()
    {
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }
        $menu_parent = self::getMenus();
        return view('auth.user.change_password', compact('menu_parent'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để thực hiện truy cập vào trang !!');
        }
        $id = \Auth::guard('nd')->user()->id;
        $user = User::find($id);
        $checkPass = \Hash::check($request->current_password, $user->password);

        if (!$checkPass) {
            return redirect()->back()->with('danger', 'Mật khẩu hiện tại không đúng');
        }

        $data = [
            'password' => \Hash::make($request->retype_password),
        ];
        $user->update($data);

        \Auth::guard('nd')->logout();

        return redirect()->route('get.user.login')->with('success', 'Mật khẩu của bạn đã thay đổi. Vui lòng đăng nhập để bắt đầu phiên làm việc !');
    }
}
