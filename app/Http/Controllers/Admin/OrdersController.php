<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (\Auth::user()->VaiTro == 2) {
            return redirect()->route('order.pack', 0);
        }
        $menu = '';
        $status = Order::STATUS_ORDER;
        $orders = Order::with('user:id,Ten,DiaChi,SDT');

        if($request->menu == 'success') {
            $menu = $request->menu;
            $orders->whereIn('TrangThai', [3,4,5]);
        } else {
            $orders->whereIn('TrangThai', [0,1,2]);
        }

        if($request->name) {
            $name = $request->name;
            $orders->whereIn('id_ND', function ($query) use($name) {
                $query->from('nguoidung')->where('Ten', 'like', '%'.$name.'%')->select('id');
            });
        }

        if($request->status) {
            $orders->where('TrangThai', $request->status);
        }
        if($request->employee_id) {

            if($request->employee_id == 'null') {
                $orders->whereNull('id_NV');
            } else {
                $orders->where('id_NV', $request->employee_id);
            }

        }

        $orders = $orders->orderBy('donhang.TrangThai', 'asc')->paginate(10);
        $shipers = User::where('VaiTro', 3)->get();
        $viewData = [
            'orders' => $orders,
            'status' => $status,
            'shipers' => $shipers,
            'menu' => $menu,
            'query'  => $request->query()
        ];

        return View('backend.order.index', $viewData);
    }

    public function show($id) {
        $orders = Order_Detail::with('product')->where('id_DH', $id)->get();
        return View('backend.order.show',compact('orders'));
    }

    public function pack($status_order) {
        $status = Order::STATUS_ORDER;
        $query = Order::with('user:id,Ten,DiaChi,SDT')->whereNotNull('id_NV')->whereNull('XacNhan');

        switch ($status_order) {
            case 0:
                $query->where('TrangThai', 0);
                break;
            case 1:
                $query->where('TrangThai', 1);
                break;
            case 3:
                $query->where('TrangThai', 3);
                break;
            case 4:
                $query->where('TrangThai', 4);
                break;
            case 5:
                $query->where('TrangThai', 5);
                break;
        }

        $orders = $query->orderBy('id', 'asc')->paginate(10);
        return View('backend.order.pack',compact('orders', 'status', 'status_order'));
    }

    public function deliver($status_order) {
        if (in_array($status_order, [1,2,3,4,5])) {
            $status = Order::STATUS_ORDER;

            $query = Order::query();
            $query->with('user:id,Ten,DiaChi,SDT');
            $query->where('id_NV', \Auth::user()->id);
            if ($status_order == 5) {
                $query->whereIn('donhang.TrangThai', [4,5]);
            } elseif ($status_order == 1) {
                $query->whereIn('donhang.TrangThai', [1,2]);
            } else {
                $query->where('donhang.TrangThai', $status_order);
            }
            $query->orderBy('donhang.TrangThai', 'asc');
            $orders = $query->paginate(10);
            return View('backend.order.deliver',compact('orders', 'status', 'status_order'));
        }
    }

    public function updateShiper(Request $request, $id)
    {
        if($request->ajax()) {
            $order = Order::find($id);
            $order->id_NV = $request->shiperId;
            $order->NgayGiao = date("Y-m-d");
            $order->save();

            return response([
                'code' => 1
            ]);
        }
    }

    public function cancel($order_id)
    {
        Order::find($order_id)->update(['TrangThai'=> 4]);
        $orderDetails = Order_Detail::where('id_DH', $order_id)->get();
        if (!$orderDetails->isEmpty()) {
            foreach($orderDetails as $orderDet) {
                $product = Product::find($orderDet->product_id);
                $product->update(['TongTien' => $product->quantities + $orderDet->quantities]);
            }
        }

        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        if($request->ajax()) {
            $order = Order::find($id);
            if($request->status == 4 || $request->status == 5) {
                $orderDetails = Order_Detail::where('id_DH', $id)->get();
                if (!$orderDetails->isEmpty()) {
                    foreach($orderDetails as $orderDet) {
                        $product = Product::find($orderDet->id_SP);
                        $product->update(['SoLuong' => $product->SoLuong + $orderDet->SoLuong]);
                    }
                }
            }
            $order->TrangThai = $request->status;
            $order->NgayGiao = date("Y-m-d");
            $order->save();

            return response([
                'code' => 1
            ]);
        }
    }

    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            Order::find($id)->delete();
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->back();
        }
    }

    public function updateConfirm(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            Order::find($id)->update([
                'XacNhan' => 1
            ]);
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->back();
        }
    }
}
