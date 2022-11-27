<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Unit;
use Auth;

class UnitController extends Controller
{
    public function unit_all()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.unit_all', compact('units'));

    } // end method

    public function unit_add()
    {
        return view('backend.unit.unit_add');

    } // end method

    public function unit_store(Request $request)
    {
        if($request->id){
            Unit::findOrFail($request->id)->update([
                'name' => $request->name,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Unit Updated Successfully', 'alert-type' => 'success',
            );
            
        }else{
            Unit::Insert([
                'name' => $request->name,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Unit Inserted Successfully', 'alert-type' => 'success',
            );
            
        }
        return redirect()->route('unit.all')->with($notification);
    } // end method

    public function unit_edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('backend.unit.unit_edit',compact('unit'));
    } // end method

    public function unit_delete($id)
    {
        $unit = Unit::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Unit Deleted Successfully', 'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // end method
}
