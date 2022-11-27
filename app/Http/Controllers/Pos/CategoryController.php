<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    public function category_all()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));

    } // end method

    public function category_add()
    {
        return view('backend.category.category_add');

    } // end method

    public function category_store(Request $request)
    {
        if($request->id){
            Category::findOrFail($request->id)->update([
                'name' => $request->name,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Category Updated Successfully', 'alert-type' => 'success',
            );
            
        }else{
            Category::Insert([
                'name' => $request->name,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Category Inserted Successfully', 'alert-type' => 'success',
            );
            
        }
        return redirect()->route('category.all')->with($notification);
    } // end method

    public function category_edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    } // end method

    public function category_delete($id)
    {
        $category = Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully', 'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // end method
}
