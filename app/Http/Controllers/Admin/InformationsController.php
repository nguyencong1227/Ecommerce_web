<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformationStoreRequest;
use App\Http\Requests\InformationUpdateRequest;
use App\Models\Information;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->title)) {
            $informations = Information::where('thongtincuahang.TieuDe', 'like', '%' . trim($request->title) . '%')->paginate(6);
        } else {
            $informations = Information::paginate(6);
        }

        return View('backend.information.index',compact('informations', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('backend.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InformationStoreRequest $request)
    {
        $informationModel          = new Information();
        $informationModel->TieuDe   = $request->title;
        $informationModel->TieuDeKhongDau    = Str::slug($request->title, '-');
        $informationModel->NoiDung = $request->contents;
        try {
            $informationModel->save();
            return redirect()->route('information.index');
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
        //lấy tất cả danh mục ứng với id
        $information = Information::find($id);
        return View('backend.information.edit',compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InformationUpdateRequest $request, $id)
    {
        $information          = Information::find($id);
        $information->TieuDe   = $request->title;
        $information->TieuDeKhongDau    = Str::slug($request->title, '-');
        $information->NoiDung = $request->contents;

        try {
            $information->save();
            return redirect()->route('information.index');
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
            Information::find($id)->delete();

            DB::commit();
            return redirect()->route('information.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('information.index');
        }
    }
}
