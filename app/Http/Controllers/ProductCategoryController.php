<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;

class ProductCategoryController extends MenuController
{
    public function detail($id) {
    	$categoryProducts = CategoryProduct::find($id);
        $idCate = [];
    	if($categoryProducts->parent_id == NULL) {
    	    $idCate = CategoryProduct::where('id_DMSPCha', $id)->pluck('id')->toArray();

        }
        array_push($idCate, intval($id));

    	$products = Product::whereIn('id_DMSP', $idCate)->where('TrangThai', 1)->orderBy('id', 'DESC')->paginate(12);
        $productNews  = Product::orderBy('id', 'DESC')->where('TrangThai', 1)->orderBy('id', 'DESC')->take(8)->get();
    	$menu_parent = self::getMenus();
        $infor = self::getInforShop();
    	return view('frontend/category_product', compact('categoryProducts', 'menu_parent', 'infor', 'products', 'productNews'));
    }
}
