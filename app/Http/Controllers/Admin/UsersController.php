<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roleUser = User::$role;
        $users = User::orderByDesc('id')->paginate(6);
        return View('backend.user.index',compact('users', 'roleUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleUser = User::$role;
        return View('backend.user.create', compact('roleUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {

        $userModel               = new User();
        $userModel->Ten         = $request->name;
        $userModel->email        = $request->email;
        $userModel->DiaChi      = $request->address;
        $userModel->HoatDong       = $request->active ? 1 : 0;
        $userModel->SDT = $request->phone_number;
        $userModel->VaiTro         = $request->role;
        $userModel->password     = Hash::make($request->password);
        try {
            $userModel->save();
            return redirect()->route('user.index');
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
        $roleUser = User::$role;
        $user   = User::find($id);
        return View('backend.user.edit',compact('user', 'roleUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user               = User::find($id);
        $user->Ten         = $request->name;
        $user->email        = $request->email;
        $user->DiaChi      = $request->address;
        $user->HoatDong       = $request->active ? 1 : 0;
        $user->SDT = $request->phone_number;
        $user->VaiTro         = $request->role;
        if($request->password) {
            $user->password     = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('user.index');
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
            User::find($id)->delete();

            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('user.index');
        }
    }
}
