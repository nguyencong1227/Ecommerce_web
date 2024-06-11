<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\CategoryProduct;
use App\Models\Coupon;
use App\Models\Coupon_Detail;
use App\Models\Product;
use App\Models\Supplier;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $listSize = Product::LIST_SIZE;
        view()->share([
            'listSize' => $listSize
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->name)) {
            $products = Product::where('sanpham.Ten', 'like', '%' . trim($request->name) . '%')->paginate(6);
        } else {
            $products = Product::paginate(6);
        }
    	//lấy tất cả danh mục và phân trang 10 sản phẩm trên 1 trang
        return View('backend.product.index',compact('products', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	//lấy tất cả danh mục
        $categoryProducts = CategoryProduct::all();
        $suppliers        = Supplier::all();
        return View('backend.product.create',compact('categoryProducts', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $couponDetailModel = new Coupon_Detail();

        $productInput['Ten']                = $request->name;
        $productInput['Gia']               = $request->price;
        $productInput['MoTa']         = $request->description;
        $productInput['SoLuong']          = $request->quantities;
        $productInput['TrangThai']              = $request->status ? 1 : 0;
        $productInput['id_DMSP'] = $request->category_product_id ? $request->category_product_id : null;
        $productInput['id_NCC']         = $request->supplier_id ? $request->supplier_id : null;

        if(!empty($request->size)) {
            $productInput['size']  = implode(',', $request->size);
        }

        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/images');
            $image = Image::make(Storage::get($imagePath))->resize(300,300)->encode();
            Storage::put($imagePath,$image);
            $imagePath = explode('/',$imagePath);
            $imagePath = $imagePath[2];
            $productInput['Anh'] = $imagePath;
        }
        DB::beginTransaction();
        try {
            // thêm sản phẩm bảng product
            $product = Product::create($productInput);
            // thêm sản phẩm bảng nhập phiếu hàng
            $couponInput['id_NV'] = Auth::user()->id;
            $coupon = Coupon::create($couponInput);
            // thêm sản phẩm bảng nhập phiếu hàng chi tiết
            $couponDetailModel->id_PN = $coupon->id;
            $couponDetailModel->id_SP = $product->id;
            $couponDetailModel->SoLuong = $request->quantities;
            $couponDetailModel->timestamps = false;
            $couponDetailModel->save();

            DB::commit();
            return redirect()->route('product.index');
        } catch (Exception $e) {
            DB::rollback();
            die($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	//lấy tất cả danh mục
        $categoryProducts = CategoryProduct::all();
        $suppliers        = Supplier::all();
        //lấy tất cả sản phẩm
        $product   = Product::find($id);
        return View('backend.product.edit',compact('product','categoryProducts', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product                      = Product::find($id);
        $product->Ten                = $request->name;
        $product->Gia               = $request->price;
        $product->MoTa         = $request->description;
        $product->SoLuong          = $request->quantities;
        $product->TrangThai              = $request->status ? 1 : 0;
        $product->id_DMSP = $request->category_product_id ? $request->category_product_id : null;
        $product->id_NCC         = $request->supplier_id ? $request->supplier_id : null;
        if(!empty($request->size)) {
            $product->size   = implode(',', $request->size);
        }

        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('public/images');
            $image = Image::make(Storage::get($imagePath))->resize(300,300)->encode();
            Storage::put($imagePath,$image);
            $imagePath = explode('/',$imagePath);
            $imagePath = $imagePath[2];
            $product->Anh = $imagePath;
        }

        try {
            $product->save();
            return redirect()->route('product.index');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	DB::beginTransaction();
        try {
            Product::find($id)->delete();
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('product.index');
        }
    }
}
