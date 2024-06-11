<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Information;

class MenuController extends Controller
{
    public static function getMenus(){
        $menus = CategoryProduct::where('TrangThai', 1)->get();
        $menu_parent = $menus->where('id_DMSPCha',null);
        if (!$menu_parent->isEmpty()) {
	        foreach($menu_parent as $menu){
	            $myArray = [];
	            foreach($menus as $m){
	                if($menu->id == $m->id_DMSPCha){
	                    array_push($myArray,$m);
	                }
	            }
	            $menu->menu_children=$myArray;
	        }
        }
        return $menu_parent;
    }

    public static function getInforShop(){
        $informations = Information::all();
        $infor = [];
        if (!$informations->isEmpty()) {
	        foreach ($informations as $inf) {
	            $infor[$inf->TieuDeKhongDau]['id'] = $inf->id;
	            $infor[$inf->TieuDeKhongDau]['title'] = $inf->TieuDe;
	            $infor[$inf->TieuDeKhongDau]['content'] = $inf->NoiDung;
	        }
	    }
        return $infor;
    }
}
