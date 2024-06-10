<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends MenuController
{
    public function create()
    {
    	$menu_parent = self::getMenus();

        $infor = self::getInforShop();
        return view('frontend/contact', compact('menu_parent', 'infor'));
    }

    public function store(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->Ten = $request->name;
            $contact->email = $request->email;
            $contact->NoiDung = $request->mess;
            $contact->save();
            return redirect()->back()->with('success', 'Cám ơn bạn đã gửi liên hệ cho chúng tôi');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', 'Đã xảy ra lỗi không thể gửi thông tin liên hệ');
        }
    }
}
