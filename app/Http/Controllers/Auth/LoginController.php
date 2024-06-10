<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\MenuController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends MenuController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
//        $this->middleware('guest')->except('logout');
    }

    public function getFormLogin()
    {

        $title_page = 'Đăng nhập';
        $menu_parent = self::getMenus();
        $infor = self::getInforShop();
        return view('auth.user.login',compact('title_page','menu_parent', 'infor'));
    }

    public function postLogin(Request $request)
    {
        if(!empty($request->email) && !empty($request->password)) {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->with('danger', 'Tài khoản mật khẩu không chính xác');
            }
            if (!\Hash::check($request->password, $user->password)) {
                return redirect()->back()->with('danger', 'Tài khoản mật khẩu không chính xác');
            }

            if (\Hash::check($request->password, $user->password)) {
                \Auth::guard('nd')->loginUsingId($user->id, true);

                \Session::flash('toastr', [
                    'type'    => 'success',
                    'message' => 'Đăng nhập thành công'
                ]);
                return redirect()->route('client.home');
            }
        }
        return redirect()->back();
    }

    public function getLogout()
    {
        \Auth::guard('nd')->logout();
        return redirect()->to('/');
    }

    public function logoutAdmin(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

    public function postAdminLogin(Request $request)
    {
        if(!empty($request->email) && !empty($request->password)) {
            $user = User::where('email', $request->email)->first();
            if (!$user || !(\Hash::check($request->password, $user->password))) {
                return redirect()->back()->with('danger', 'Tài khoản mật khẩu không chính xác');
            }

            if ($user->VaiTro == 0) {
                return redirect()->back()->with('danger', 'Bạn không có quyền truy cập trang quản trị');
            }

            if (\Hash::check($request->password, $user->password)) {
                \Auth::loginUsingId($user->id, true);

                \Session::flash('toastr', [
                    'type'    => 'success',
                    'message' => 'Đăng nhập thành công'
                ]);
                return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->back();
    }
}
