<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;

class BillingController extends Controller
{
    //
    public function billing($id)
    {
        $infoUser = Order::with('user', 'donated')->find($id);
        //dd($infoUser->toArray());
        $status = Order::STATUS_ORDER;
        if(!$infoUser) {
            return redirect()->route('list.order.transported')->with('danger', 'Đơn hàng không tồn tại !!');
        }

        $orders = Order_Detail::with('product')->where('id_DH', $id)->get();
        return view('common.billing', compact('infoUser', 'orders', 'status'));
    }
}
