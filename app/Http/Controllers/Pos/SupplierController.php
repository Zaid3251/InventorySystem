<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Supplier;
use Auth;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function supplier_all()
    {
        // $suppliers =Supplier::all();
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('suppliers'));

    } // end method

    public function supplier_add()
    {
        return view('backend.supplier.supplier_add');

    } // end method

    public function supplier_store(Request $request)
    {
        if($request->id){
            Supplier::findOrFail($request->id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Supplier Updated Successfully', 'alert-type' => 'success',
            );
            
        }else{
            Supplier::Insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Supplier Inserted Successfully', 'alert-type' => 'success',
            );
            
        }
        return redirect()->route('supplier.all')->with($notification);
    } // end method

    public function supplier_edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit',compact('supplier'));
    } // end method

    public function supplier_delete($id)
    {
        $supplier = Supplier::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully', 'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // end method
}
