<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Auth','prefix' => 'thanh-vien'], function(){
    Route::get('dang-ky','RegisterController@getFormRegister')->name('get.user.register'); // đăng ký
    Route::post('dang-ky','RegisterController@postRegister'); // xử lý đăng ký

    Route::get('dang-nhap','LoginController@getFormLogin')->name('get.user.login'); // đăng nhập
    Route::post('dang-nhap','LoginController@postLogin')->name('post.user.login'); // xử lý đăng nhập

    Route::get('dang-xuat','LoginController@getLogout')->name('get.user.logout'); // đăng xuất

});


Route::get('/', 'HomeController@index')->name('client.home');
Route::get('/product/{id}', 'ProductController@detail')->name('client.product_detail');
Route::get('/contact', 'ContactController@create')->name('client.contact_create');
Route::post('contact', 'ContactController@store')->name('post.contact');
Route::get('/about', 'PageController@about')->name('client.about');
Route::get('/shopping-guide', 'PageController@shoppingGuide')->name('client.shopping_guide');
Route::get('/policy', 'PageController@policy')->name('client.policy');
Route::get('/login', 'LoginController@create')->name('client.login_create');
Route::get('/category_product/{id}', 'ProductCategoryController@detail')->name('client.category_producte_detail');
Route::get('search', 'HomeController@search')->name('client.search');
Route::get('/info/user', 'InfoUserController@index')->name('info.user');
Route::post('/update/info/user', 'InfoUserController@updateInfoUser')->name('update.info.user');
Route::get('list/order/transported', 'InfoUserController@listOrderTransported')->name('list.order.transported');
Route::get('cancel/order/{id}', 'InfoUserController@cancelOrder')->name('cancel.order');
Route::get('list/order/success', 'InfoUserController@listOrderSuccess')->name('list.order.success');
Route::get('/billing/{id}', 'BillingController@billing')->name('billing');
Route::get('/change/password', 'InfoUserController@getFormChangePasswor')->name('change.password');
Route::post('/change/password', 'InfoUserController@changePassword')->name('change.password');

Route::get('don-hang.html','ShoppingCartController@index')->name('get.shopping.list'); // gio hang
Route::prefix('shopping')->group(function () {
    Route::get('add/{id}','ShoppingCartController@add')->name('get.shopping.add'); // thêm giỏ hàng
    Route::get('delete/{id}','ShoppingCartController@delete')->name('get.shopping.delete'); // xoá sp trong gi hàng
    Route::get('update/{id}','ShoppingCartController@update')->name('ajax_get.shopping.update'); // cập nhật
    Route::get('info/payment', 'ShoppingCartController@getFromPayment')->name('get.info.payment');
    Route::post('pay','ShoppingCartController@saveOrder')->name('post.shopping.pay'); // xử lý giỏ hàng lưu thông tin
    Route::get('delete-all','ShoppingCartController@deleteAll')->name('get.shopping.delete_all'); // xử lý giỏ hàng lưu thông tin
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::resource('product', 'ProductController')->except(['show']);
        Route::resource('order', 'OrdersController');
        Route::get('order/pack/{flg}', 'OrdersController@pack')->name('order.pack');
        Route::get('order/deliver/{status}', 'OrdersController@deliver')->name('order.deliver');
        Route::delete('order/cancel/{order_id}', 'OrdersController@cancel')->name('order.cancel');
        Route::post('update/shiper/{id}', 'OrdersController@updateShiper')->name('order.shiper.status');
        Route::post('update/status/{id}', 'OrdersController@updateStatus')->name('order.update.status');
        Route::resource('category_product', 'CategoryProductController')->except(['show']);
        Route::resource('supplier', 'SuppliersController')->except(['show']);
        Route::resource('information', 'InformationsController')->except(['show']);
        Route::resource('user', 'UsersController')->except(['show']);
        Route::get('/contact', 'ContactsController@index')->name('contact.index');
        Route::delete('contact/destroy/{id}', 'ContactsController@destroy')->name('contact.destroy');
        Route::get('update/confirm/{id}', 'OrdersController@updateConfirm')->name('order.update.confirm');
    });
    Route::middleware(['is_role_access'])->group(function () {
        Route::resource('order', 'OrdersController')->except(['show']);
    });
});
Auth::routes(['register' => false]);
Route::get('/logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('admin/logout', 'Auth\LoginController@logoutAdmin')->name('auth.admin.logout');
Route::post('admin/login', 'Auth\LoginController@postAdminLogin')->name('auth.admin.login');
Route::get('/home', 'HomeController@index')->name('home');
