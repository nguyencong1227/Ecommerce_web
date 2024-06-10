<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryProductStoreRequest;
use App\Http\Requests\CategoryProductUpdateRequest;
use App\Models\CategoryProduct;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoryProduct = CategoryProduct::with('category_product_parent');

        if (isset($request->name)) {
            $categoryProduct->where('danhmucsanpham.ten', 'like', '%' . trim($request->name) . '%');
        }

        $categoryProduct = $categoryProduct->paginate(13);

        return View('backend.category_product.index',compact('categoryProduct', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	//lấy tất cả danh mục
        $categoryProduct = CategoryProduct::all();
        return View('backend.category_product.create',compact('categoryProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryProductStoreRequest $request)
    {
        $categoryProductModel                     = new CategoryProduct();
        $categoryProductModel->ten               = $request->name;
        $categoryProductModel->TrangThai         = $request->status ? 1 : 0;
        $categoryProductModel->id_DMSPCha        = $request->parent_id;
        $categoryProductModel->timestamps = false;
        try {
            $categoryProductModel->save();
            return redirect()->route('category_product.index');
        } catch (Exception $e) {
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
        $categoryProductAll = CategoryProduct::where('id_DMSPCha' , '<>', $id)
        					->orwhereNull('id_DMSPCha')
        					->get();
        //lấy tất cả danh mục ứng với id
        $categoryProduct   = CategoryProduct::find($id);
        return View('backend.category_product.edit',compact('categoryProductAll','categoryProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryProductUpdateRequest $request, $id)
    {
        $categoryProduct                   	= CategoryProduct::find($id);
        $categoryProduct->ten               = $request->name;
        $categoryProduct->TrangThai         = $request->status ? 1 : 0;
        $categoryProduct->id_DMSPCha        = $request->parent_id;
        $categoryProduct->timestamps = false;

        try {
            $categoryProduct->save();
            return redirect()->route('category_product.index');
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
        	//gán khóa ngoại category_product_id bảng product là null
            Product::join('danhmucsanpham', 'danhmucsanpham.id', '=', 'sanpham.id_DMSP')
                ->where('danhmucsanpham.id', $id)->update(['id_DMSPCha' => null]);
            //gán khóa ngoại category_product_id bảng product là null (trong trường hợp có thể loại con của thể laoij bị xóa)
            Product::join('danhmucsanpham', 'danhmucsanpham.id', '=', 'sanpham.id_DMSP')
                ->where('id_DMSPCha', $id)->update(['id_DMSPCha' => null]);
            //gán parent_id của thằng category con kế thừa thằng bị xóa về null
            CategoryProduct::where('id_DMSPCha', $id)->update(['id_DMSPCha' => null]);
            CategoryProduct::find($id)->delete();

            DB::commit();
            return redirect()->route('category_product.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('category_product.index');
        }
    }
}
