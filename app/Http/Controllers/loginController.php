<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends MenuController
{
    public function create()
    {
    	$menu_parent = self::getMenus();

        $infor = self::getInforShop();
        return view('frontend/login', compact('menu_parent', 'infor'));
    }
}
