<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use DB;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if (isset($request->name)) {
            $contacts = Contact::where('Ten', 'like', '%' . trim($request->name) . '%')->paginate(6);
        } else {
            $contacts = Contact::paginate(6);
        }
        return View('backend.contact.index',compact('contacts', 'request'));
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
            Contact::find($id)->delete();
            DB::commit();
            return redirect()->route('contact.index');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('contact.index');
        }
    }
}
