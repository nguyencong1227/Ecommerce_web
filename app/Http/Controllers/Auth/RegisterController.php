<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\MenuController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends MenuController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function getFormRegister()
    {
        $title_page = 'Đăng ký';
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        return view('auth.user.register', compact('title_page','menu_parent', 'infor'));
    }

    public function postRegister(RegisterRequest $request)
    {
        $data['Ten'] =  $request->name;
        $data['email'] =  $request->email;
        $data['DiaChi'] =  $request->address;
        $data['SDT'] =  $request->phone_number;
        $data['password']   =  Hash::make($request->password);
        $data['NgayTao'] = Carbon::now();
        $id = User::insertGetId($data);


        if ($id) {
            \Session::flash('toastr', [
                'type'    => 'success',
                'message' => 'Đăng ký thành công'
            ]);

            if (\Auth::guard('nd')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('client.home');
            }

            return redirect()->route('get.login');
        }

        return redirect()->back();
    }
}
