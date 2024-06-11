<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends MenuController
{
    public function about()
    {
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        return view('frontend.about',compact('menu_parent', 'infor'));
    }

    public function shoppingGuide()
    {
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        return view('frontend.shopping_guide',compact('menu_parent', 'infor'));
    }
    public function policy()
    {
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        return view('frontend.policy',compact('menu_parent', 'infor'));
    }
}
