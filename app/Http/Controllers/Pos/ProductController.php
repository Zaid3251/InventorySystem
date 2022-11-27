<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use Auth;
class ProductController extends Controller
{
    public function product_all()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
        
    } // end method
    
    public function product_add()
    {
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();
        return view('backend.product.product_add',compact('suppliers','categories','units'));

    } // end method
    public function product_store(Request $request)
    {
        if($request->id){
            Product::findOrFail($request->id)->update([
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'quantity' => '0',
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Updated Successfully', 'alert-type' => 'success',
            );
            
        }else{
            Product::Insert([
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'quantity' => '0',
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Product Inserted Successfully', 'alert-type' => 'success',
            );
            
        }
        return redirect()->route('product.all')->with($notification);
    } // end method
    public function product_edit($id)
    {
        $suppliers = Supplier::latest()->get();
        $categories = Category::latest()->get();
        $units = Unit::latest()->get();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('product','suppliers','categories','units'));
    } // end method
    public function product_delete($id)
    {
        $product = Product::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully', 'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // end method

}
