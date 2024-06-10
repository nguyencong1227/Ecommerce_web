<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends MenuController
{
    public function index()
    {
        $infor = self::getInforShop();
        $shopping    = \Cart::content();
        $menu_parent = self::getMenus();

        if(empty($shopping->toArray())) {

            \Session::flash('toastr', [
                'type'    => 'error',
                'message' => 'Không tồn tại sản phẩm trong giỏ hàng'
            ]);
            return redirect()->route('client.home');
        }

        $viewData    = [
            'title_page'  => 'Danh sách giỏ hàng',
            'shopping'    => $shopping,
            'menu_parent' => $menu_parent,
            'infor' => $infor
        ];
        return view('frontend.cart', $viewData);
    }

    /**
     * Thêm giỏ hàng
     * */
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        //1. Kiểm tra tồn tại sản phẩm
        if (!$product) return redirect()->to('/');

        // 2. Kiểm tra số lượng sản phẩm
        if ($product->SoLuong < $request->qty) {
            //4. Thông báo
            return response([
                'code' => 0,
                'message' => 'Số lượng sản phẩm trong kho không đủ'
            ]);
        }
        $cart          = \Cart::content();
        $idCartProduct = $cart->search(function ($cartItem) use ($product) {
            if ($cartItem->id == $product->id) return $cartItem->id;
        });
        $qty = $request->qty ?? 1;
        if ($idCartProduct) {
            $productByCart = \Cart::get($idCartProduct);
            if ($product->SoLuong < ($productByCart->qty + $request->qty)) {
                return response([
                    'code' => 0,
                    'message' => 'Số lượng sản phẩm trong kho không đủ'
                ]);
            }
        }

        // 3. Thêm sản phẩm vào giỏ hàng
        $dataCheck = [
            'product' => $product,
            'size' => $request->size
        ];

        $idProduct = $cart->search(function ($cartItem) use ($dataCheck) {
            if ($cartItem->id == $dataCheck['product']->id && $cartItem->options['size'] == $dataCheck['size']) return $cartItem->id;
        });

        if (empty($idProduct)) {
            \Cart::add([
                'id'      => $product->id,
                'name'    => $product->Ten,
                'qty'     => $qty,
                'price'   => $product->Gia,
                'weight'  => '1',
                'options' => [
                    'image' => $product->Anh,
                    'size'  => $request->size
                ]
            ]);
        } else {
            $productByCart = \Cart::get($idCartProduct);
            $qty = $productByCart->qty + $request->qty;
            \Cart::update($idProduct, $qty);
        }

        //4. Thông báo
        \Session::flash('toastr', [
            'type'    => 'success',
            'message' => 'Thêm giỏ hàng thành công'
        ]);

        return response([
            'code' => 1,
            'total' => \Cart::count()
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            if($request->qty) {
                //1.Lấy tham số
                $qty       = $request->qty ?? 1;
                $idProduct = $request->idProduct;
                $product   = Product::find($idProduct);

                //2. Kiểm tra tồn tại sản phẩm
                if (!$product) return response(['messages' => 'Không tồn tại sản sản phẩm cần update']);

                //3. Kiểm tra số lượng sản phẩm còn ko
                if ($product->SoLuong < $qty) {
                    return response([
                        'messages' => 'Số lượng cập nhật không đủ',
                        'error'    => true
                    ]);
                }

                //4. Update
                \Cart::update($id, $qty);

                return response([
                    'messages'   => 'Cập nhật thành công',
                    'totalMoney' => \Cart::subtotal(0),
                    'totalItem'  => number_format($product->Gia * $qty, 0, ',', '.'),
                    'total' => \Cart::count()
                ]);
            } else {
                $idProduct = $request->idProduct;
                $product   = Product::find($idProduct);

                //2. Kiểm tra tồn tại sản phẩm
                if (!$product) return response(['messages' => 'Không tồn tại sản sản phẩm cần update']);
                $options = [
                    'image' => $product->Anh,
                    'size'  => $request->size
                ];

                \Cart::update($id, ['options' => $options]);
                return response([
                    'messages'   => 'Cập nhật thành công',
                    'total' => \Cart::count()
                ]);
            }

        }
    }

    public function deleteAll()
    {
        \Cart::destroy();

        return redirect()->route('client.home');
    }

    public function getFromPayment()
    {
        $user = \Auth::guard('nd')->user();
        $infor = self::getInforShop();
        if (\Auth::guard('nd')->user() == null) {
            return redirect()->route('get.user.login')->with('danger', 'Bạn cần đăng nhập để tiến hành đặt hàng !!');
        }
        $products = \Cart::content();
        $menu_parent = self::getMenus();
        return view('frontend.payment', compact('menu_parent', 'products', 'user', 'infor'));
    }

    public function saveOrder(OrderRequest $request)
    {
        $totalMoney    = str_replace(',', '', \Cart::subtotal(0, 3));
        DB::beginTransaction();
        try {
            $orderId = Order::insertGetId([
                'id_ND' => \Auth::guard('nd')->user()->id,
                'TongTien'   => (int)$totalMoney,
                'GhiChu' => $request->message,
                'TrangThai'  => 0,
                'NgayCN' => Carbon::now(),
                'NgayTao' => Carbon::now()
            ]);
            if ($request->gui_tang) {
                DB::table('guitang')->insert([
                    'id_DH' => $orderId,
                    'TenNN'    => $request->name,
                    'DiaChi' => $request->address,
                    'SDT'   => $request->phone,
                    'email'   => $request->email,
                ]);
            }

            if ($orderId) {
                $productOrder = \Cart::content();
                foreach ($productOrder as $proOrder) {
                    Order_Detail::insert([
                        'id_DH'   => $orderId,
                        'id_SP' => $proOrder->id,
                        'SoLuong' => $proOrder->qty,
                        'Gia'      => $proOrder->price,
                        'size'       => $proOrder->options->size,
                        'NgayTao' => Carbon::now(),
                        'NgayCN' => Carbon::now()
                    ]);
                    // cập nhật số lượng sản phẩm sau khi đặt hàng
                    $product = Product::where('id', $proOrder->id)->first();
                    $product->update(['SoLuong' => $product->SoLuong - $proOrder->qty]);
                }
            }

            \Cart::destroy();
            DB::commit();
            return redirect()->route('client.home')->with('success', 'Chúc mừng bạn đã đặt hàng thành công. Chúng tôi sẽ hệ và giao hàng sớm nhất cho bạn.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('errors', 'Đã sảy ra lỗi không thể đặt hàng');
        }
    }

    /**
     *  Xoá sản phẩm đơn hang
     * */
    public function delete(Request $request, $rowId)
    {
        \Cart::remove($rowId);
        return redirect()->back();
    }
}
