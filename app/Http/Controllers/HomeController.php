<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends MenuController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productViews = Product::where('TrangThai', 1)->orderBy('SLBan', 'DESC')->take(6)->get();
        $productNews  = Product::where('TrangThai', 1)->orderBy('id', 'DESC')->take(12)->get();
        $productSale  = Product::where('TrangThai', 1)->orderBy('XLXem', 'DESC')->take(8)->get();

        $menu_parent = self::getMenus();
        $infor = self::getInforShop();

        return view('frontend/home', compact('menu_parent', 'infor', 'productNews', 'productViews', 'productSale'));
    }

    public function search(Request $request)
    {
        $products = [];
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        if($request->key_search) {
            $keySearch = $request->key_search;
            $products = Product::where('Ten', 'like', '%'.$keySearch.'%')->where('TrangThai', 1)->orderBy('id', 'DESC')->paginate(12);
        }

        return view('frontend.search', compact('products', 'menu_parent', 'infor'));
    }
}
